<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'filename',
        'is_selling'
    ];

    /**
     * Shopを所有しているOwnerを取得
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
