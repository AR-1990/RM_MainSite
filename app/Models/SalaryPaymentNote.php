<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPaymentNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_payment_id',
        'note',
        'created_by',
    ];

    public function payment()
    {
        return $this->belongsTo(SalaryPayment::class, 'salary_payment_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}


