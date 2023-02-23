<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function scopeWaktu()
    {
        if (\Carbon\Carbon::now() > $this->created_at->addDays(2)) {
            $readableDate = $this->created_at->format('d M Y'); //->toDayDateTimeString()
        } else {
            $readableDate = $this->created_at->diffForHumans();
        }

        return $readableDate;
    }
    
    public function detailsale()
    {
        return $this->hasMany(Detailsale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
