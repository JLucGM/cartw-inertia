<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


/**
 * Class Product
 *
 * @property $id
 * @property $name
 * @property $price
 * @property $description
 * @property $status
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model 
{


  static $rules = [
    'name' => 'required',
    'price' => 'required',
    'description' => 'required',
    'status' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'price',
    'description',
    'status',
    'business_id'
  ];

  
}
