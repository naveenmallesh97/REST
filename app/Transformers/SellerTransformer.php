<?php

namespace App\Transformers;
use App\Seller;

use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
        'identifier' => (int)$seller->id,
        'name' => (string)$seller->name,
        'email' => (string)$seller->email,
        'isVerified' => (string)$seller->email,
        'creationDate' => (string)$seller->created_at,
        'lastChange' => (string)$seller->updated_at,
        'deletedDate' => isset($seller->deleted_at) ? (string) $seller->deleted_at : null,
            //
        ];
    }
    public static function originalAttribute($index)
    {
        $attributes = [
        'identifier' => 'id',
        'name' => 'name',
        'email' => 'email',
        'isVerified' => 'verified',
        'creationDate' => 'created_at',
        'lastChange' => 'updated_at',
        'deletedDate' => 'deleted_at',
        ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}