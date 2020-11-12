<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
             'identifier' => (int)$category->id,
             'title' => (string)$category->name,
             'details' => (string)$category->description,
             'creationDate' => (string)$category->created_at,
             'lastChange' => (string)$category->updated_at,
             'deletedDate' => isset($category->deleted_at) ? (string) $category->deleted_at : null,
        
        'links'=>[
            [
                'rel' => 'self',
                'href' => route('categories.show', $catgory->id),
            ],
            [
                'rel' => 'category.buyers',
                'href' => route('categories.buyers.index', $catgory->id),
            ],
            [

                'rel' => 'category.products',
                'href' => route('categories.products.index', $catgory->id),
            ],
            [

                'rel' => 'category.sellers',
                'href' => route('categories.sellers.index', $catgory->id),
            ],
            [
                'rel' =>'category.transactions',
                'href' =>route('categories.transactions.index', $category->id),
            ],
            
        ]
    ];
}

    public static function originalAttribute($index)
    {
     $attributes = [
        'identifier' => 'id',
        'title' => 'name ',
        'details' => 'description',
        'creationDate' => 'created_at',
        'lastChange' => 'updated_at',
        'deletedDate' => 'deleted_at',
        ];
        
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
