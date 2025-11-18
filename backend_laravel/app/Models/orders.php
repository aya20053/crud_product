<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
protected $fillable = ['product_id', 'customer_id', 'quantity', 'total_price'];

public function product() {
    return $this->belongsTo(Product::class);
}

public function customer() {
    return $this->belongsTo(customer::class);
}

}
