 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
/**buyers
*buyers
*/
Route::resource('buyers', 'Buyer\BuyerController',['only' => ['index','show']]);
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController', ['only' => ['index']]);
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' => ['index']]);
Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only' => ['index']]);
Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only' => ['index']]);
/**categories
*categories
*/

Route::resource('categories','Category\CategoryController',['except' => ['create','edit']]);
Route::resource('categories.buyers','Category\CategoryBuyerController',['only' => ['index']]);
Route::resource('categories.products','Category\CategoryProductController',['only' => ['index']]);
Route::resource('categories.sellers','Category\CategorySellerController',['only' => ['index']]);
Route::resource('categories.transactions','Category\CategoryTransactionController',['only' => ['index']]);
//Route::resource('categories','Category\CategoryController',['except' => ['create','edit']]);


/**products
*products
*/

Route::resource('products','Product\ProductController',['only' => ['index','show']]);
Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::resource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);
Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update','destroy']]);
Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);
/**sellers
*sellers
*/

Route::resource('sellers','Seller\SellerController',['only' => ['index','show']]);
Route::resource('sellers.buyers','Seller\SellerBuyerController',['only' => ['index','show']]);
Route::resource('sellers.products','Seller\SellerProductController',['except' => ['create','show','edit']]);
Route::resource('sellers.categories','Seller\SellerCategoryController',['only' => ['index','show']]);
Route::resource('sellers.transactions','Seller\SellerTransactionController',['only' => ['index','show']]);
/**transactions
*transactions
*/ 

Route::resource('transactions','Transaction\TransactionController',['only' => ['index','show']]);
Route::resource('transactions.categories','Transaction\TransactionCategoryController',['only' => ['index']]);
Route::resource('transactions.sellers','Transaction\TransactionSellerController',['only' => ['index']]);

/**users
*users
*/
Route::resource('users','Controller@test');
Route::resource('users', 'User\UserController',['except' => ['edit']]);


Route::name('verify')->get('users\verify\{token}', 'User\UserController@verify');// changed  to  \ \ slashes
Route::name('resend')->get('users\{user}\resend', 'User\UserController@resend');//changed to \  \ slashes


//Route::post('users','user\UserController@store');

