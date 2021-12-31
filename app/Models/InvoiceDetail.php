<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'invoice_id', 'price', 'quantity', 'total_product'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
