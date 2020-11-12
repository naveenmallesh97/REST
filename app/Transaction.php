<?php

namespace App;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Buyer;
use App\Product;

class transaction extends Model
{
	use SoftDeletes;
	public $transformer = TransactionTransformer::class;
	protected $dates = ['deleted_at'];

    protected $fillable = [
	' quantity',
	'buyer_id',
	'product_id',
];

public function buyer()
{
return $this->belongsTo(Buyer::class);//buyer
    //
}
public function product()
{
	return $this->belongsTo(Product::class);//product
}
}
