<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function scopeWaktu()
    {
        if (\Carbon\Carbon::now() > $this->created_at->addDays(4)) {
            $readableDate = $this->created_at->format('d M Y'); //->toDayDateTimeString()
        } else {
            $readableDate = $this->created_at->diffForHumans();
        }

        return $readableDate;
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
    
    public function inmessage()
    {
        return $this->hasMany(Inmessage::class);
    }
    
    public function outmessage()
    {
        return $this->hasMany(Outmessage::class);
    }
}
