<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =  [
        'id_product','id_seller',
        'id_delivery','id_transactions',
        'buyer_name','buyer_address','contact',
        'city','postalcode','time',
        'status_payment','status_delivery'
    
    
    ];
}
