<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'receipts';
    protected $fillable = [
                   'order_id',  'product_id', 
                    'amount', 'unitprice',
                    'discount','quantity',
                   /*payment_type is in transaction table */
    ];           
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
  /*  public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }*/
}
