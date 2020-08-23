<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = "booking_detail";
    public $primaryKey = "id";
    public $timestamps = false;
}
