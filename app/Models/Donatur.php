<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'fundraising_id',
        'total_amount',
        'notes',
        'proof',
        'is_paid',
    ];

    public function fundraising(){
        return $this->belongsTo(Fundraising::class);
    }
}