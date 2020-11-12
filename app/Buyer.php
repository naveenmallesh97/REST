<?php
 namespace App;

use Illuminate\Support\Str;
use App\Scopes\BuyerScope;
//use App\User;
use App\Transaction;

class Buyer extends User
{

    public $transformer = BuyerTransformer::class;

	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new BuyerScope);
	}
//	protected $table = "users";

//protected $filliable  = [
//"id", 
//""
//];


    public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}
    //
}
