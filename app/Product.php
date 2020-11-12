<?php

namespace App;
use App\Seller;
use App\Category;
use App\Transaction;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
  use SoftDeletes;

	const AVAILABLE_PRODUCT= 'available';
	const UNAVAILABLE_PRODUCT='unavailable';

   
   public $transformer = ProductTransformer::class;
   protected $dates = ['deleted_at'];
   protected $fillable = [
    	'name',
    	'quantity',
    	'description',
    	'status',
    	'image',
    	'seller_id',
  ];
  protected $hidden = [
        'pivot'
  ];

  public function isAvailable()
    {
    	return $this->status == product::AVAILABLE_PRODUCT;

    }

   public function seller()
   {
   	return $this->belongsTo(Seller::class);
   }
   public function transaction()
   {
   	return $this->hasMany(Transaction::class);
   }
    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }
}
