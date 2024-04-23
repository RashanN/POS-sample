<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'child';
    protected $fillable = [
        'customer_id',
        'dob',
        'name',
    ];
    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
