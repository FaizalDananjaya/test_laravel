<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageservice extends Model
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}