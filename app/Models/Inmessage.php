<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('customer', function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
                ->orwhere('title', 'like', '%' . $search . '%')
                ->orwhere('about', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });
    }

    public function scopeWaktu()
    {
        if (\Carbon\Carbon::now() > $this->created_at->addDays(4)) {
            $readableDate = $this->created_at->format('d M Y'); //->toDayDateTimeString();
        } else {
            $readableDate = $this->created_at->diffForHumans();
        }

        return $readableDate;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
