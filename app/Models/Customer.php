<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
                   'Name','Address' , 'PhoneNo'
    ];

  /*  public function receipt()
    {
        return $this->hasMany(Receipt::class);
    } */
}
