<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id",
        "amount"
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
