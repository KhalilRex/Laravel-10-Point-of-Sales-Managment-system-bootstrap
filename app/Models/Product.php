<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Receipt;
use App\Models\Cart;
use Illuminate\Pagination\Paginator;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
                   'categories_Id',  'Title',
                   'Description', 'Image', 
                   'Price','Sale'/*Quantity*/,
                   'alert_stock','qrcode',
                   'product_image' /*code*/,' barcode'
    ];

  
    public function orderdetail()
    {
        return $this->hasMany(Receipt::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    
}
