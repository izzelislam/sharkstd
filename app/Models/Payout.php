<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id",
        "amount",
        "code",
        "account_number",
        "account_type",
        "status",
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
