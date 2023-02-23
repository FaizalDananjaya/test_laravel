<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        //whereHas mencari nama relasi
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
        
        //whereHas mencari nama relasi
        $query->when($filters['author'] ?? false, fn ($query, $author)=>
            $query->whereHas('employee', fn ($query) =>
                $query->where('nama', $author)
            )
        );
    }
    
    public function scopeWaktu()
    {
        if (\Carbon\Carbon::now() > $this->created_at->addDays(4)) {
            $readableDate = $this->created_at->format('d M Y'); //->toDayDateTimeString()
        } else {
            $readableDate = $this->created_at->diffForHumans();
        }

        return $readableDate;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
