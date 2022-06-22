<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaction','product_name','buyer_address','product_weight','delivery_fee','time','status','no_resi'];

}



