<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraising extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'target_amount', 'about', 'is_active', 'has_finished', 'thumbnail', 'fundraiser_id', 'category_id'];

    // ORM

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }
    public function donaturs()
    {
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }
    public function totalReachedAmount()
    {
        return $this->donaturs()->sum('total_amount');
    }
    

    public function withdrawals()
    {
        return $this->hasMany(FundraisingWithdrawal::class);
    }

    public function fundraising_phases()
    {
        return $this->hasMany(FundraisingPhase::class);
    }

    public function getPercentageAttribute(){
        $totalDonations = $this->totalReachedAmount();
        if($this->target_amount > 0){
            $percentage = ($totalDonations / $this->target_amount) * 100;
            return $percentage > 100 ? 100 : $percentage;
        }
        return 0;
    }

}