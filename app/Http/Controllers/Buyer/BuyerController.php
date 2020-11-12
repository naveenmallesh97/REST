<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Support\Facades\Auth; 

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Transaction;
use App\Buyer;
use App\User;


class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
         
       $buyers = Buyer::has('transactions')->get();//('transactions')

        //return response()->json(['data' => $buyers], 200);
       return $this ->showAll($buyers);
     }   
    
     
    public function show(Buyer $buyer)
    {
        //$buyer = Buyer::has('transactions')->findOrFail($id);

        //return response()->json(['data' => $buyer], 200);
        return $this ->showOne($buyer);

        
    }
 }   
