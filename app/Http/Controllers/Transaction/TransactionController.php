<?php

namespace App\Http\Controllers\Transaction;
use App\Transaction;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;


class TransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transactions)
    {
        $transactions = Transaction::all();
        return $this->showAll($transactions);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function show(Transaction $transaction)
    {
         return $this->showOne($transaction);
        
    }
}
   
    

