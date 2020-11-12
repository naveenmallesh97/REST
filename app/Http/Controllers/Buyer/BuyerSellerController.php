<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Product;
use App\Seller;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *PP
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
        ->with('product.seller')
        ->get()//;
        ->pluck('product.seller')
        ->unique('id')//;
        ->values();


        return $this->showAll($sellers);
    }
    
}