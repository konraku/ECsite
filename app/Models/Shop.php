<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;

class Shop extends Model
{
    use HasFactory;

    /**
     * Shopを所有しているOwnerを取得
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
