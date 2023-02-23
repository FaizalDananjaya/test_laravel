<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('tabel', function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
                ->orWhere('name', 'like', '%' . $search . '%');
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function outmessage()
    {
        return $this->hasMany(Outmessage::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function faq()
    {
        return $this->hasMany(Faq::class);
    }

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function tabel()
    {
        return $this->belongsTo(Tabel::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
