<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Business extends Model
{

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'direction', 
        'rif'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // app/Models/Business.php

public function products()
{
    return $this->hasMany(Product::class);
}
}
