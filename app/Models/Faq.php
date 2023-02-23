<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Faq extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('category', function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
                ->orWhere('question', 'like', '%' . $search . '%');
        });
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
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }
}
