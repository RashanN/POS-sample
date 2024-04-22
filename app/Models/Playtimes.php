<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playtimes extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = ['intime', 'outtime', 'date', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
