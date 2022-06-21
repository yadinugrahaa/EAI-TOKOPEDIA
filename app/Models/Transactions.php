<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = ['seller_name','buyer_name','buyer_address','product_name','nominal_payment','delivery_fee','total_payment','time','status_payment'];


}