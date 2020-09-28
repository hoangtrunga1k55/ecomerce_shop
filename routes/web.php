<?php

use Illuminate\Support\Facades\Route;
use App\Banner;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('intern','InternController@index');
Route::get('convert','InternController@convert');
Route::post('intern','InternController@postData')->name('post.Data');
Route::post('convert','InternController@convertToMP4');
Route::get('ajax', 'AjaxImageUploadController@index');
Route::post('ajax/action', 'AjaxImageUploadController@action')->name('ajaxupload.action');

Route::post('xxx', 'HomeController@action');

Route::resource('posts', 'PostController');

Route::get('check_curl', 'HomeController@getData');
Route::post('upload', 'HomeController@Upload');
Route::post('post', 'HomeController@postData');
Route::delete('delete/{id}', 'HomeController@deleteData');
Route::get('edit/{id}', 'HomeController@editData');

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['userLogin'])->group(function () {
    Route::get('myorder', function () {
        $orders = \App\Order::all();
        return view('pages.myorder',['orders'=>$orders]);
    });
    Route::get('wishlist', function () {
        return view('pages.wishlist');
    });
    Route::get('/myaccount', function () {
        $menus = \App\Menu::all();
        return view('pages.myaccount',['menus'=>$menus]);
    });
});



Route::get('index', 'PageController@getBanner');
Route::get('/product_detail', function () {
    return view('pages.product_detail');
});

Route::get('/cart', 'CartController@getCart');
Route::get('/cart/delete/{id}', 'CartController@deleteCart');
Route::post('/cart', 'CartController@postCart');
Route::post('/cart/update/{id}', 'CartController@updateCart');


//checkout
Route::get('/checkout','CheckoutController@getCheckout');
Route::post('/checkout','CheckoutController@postCheckout');
//top
Route::get('/top/{id}', 'ProductController@getTopProduct');

//bottom
Route::get('/bottom/{id}', 'ProductController@getBottomProduct');

//jacket
Route::get('/jacket/{id}', 'ProductController@getJacketProduct');

//hoddies
Route::get('/hoddies/{id}', 'ProductController@getHoddiesProduct');

//tshirt
Route::get('/tshirt/{id}', 'ProductController@getTshirtProduct');

Route::get('/product', 'ProductController@getProduct');
Route::get('/product/detail/{id}', 'PageController@getProductDetail');
Route::get('register', 'PageController@getRegister');
Route::post('register', 'PageController@postRegister');
Route::get('login', 'PageController@getLogin');
Route::post('login', 'PageController@postLogin');
Route::get('logout', 'PageController@getLogout');
Route::get('admin/logout', 'AdminController@getLogout');
Route::get('admin/login', function () {
    return view('admin.login');
});

Route::post('admin/login','AdminController@postLogin');

Route::group(['prefix'=>'admin','middleware' => 'adminLogin'],function (){
    Route::get('index', function () {
        return view('admin.pages.index');
    });
    //user
    Route::group(['prefix'=>'user'],function (){
        Route::get('list','UserController@getList');
        Route::get('add','UserController@getAdd');
        Route::get('edit/{id}','UserController@getEdit');
        Route::get('delete/{id}','UserController@getDelete');
        Route::post('add','UserController@postAdd');
        Route::post('edit/{id}','UserController@postEdit');
    });
    //product
    Route::get('list','ProductController@getList');
    Route::get('add','ProductController@getAdd');
    Route::get('edit/{id}','ProductController@getEdit');
    Route::get('delete/{id}','ProductController@getDelete');
    Route::post('add','ProductController@postAdd');
    Route::post('edit/{id}','ProductController@postEdit');
    //banner
    Route::get('list','BannerController@getList');
    Route::get('add','BannerController@getAdd');
    Route::get('edit/{id}','BannerController@getEdit');
    Route::get('delete/{id}','BannerController@getDelete');
    Route::post('add','BannerController@postAdd');
    Route::post('edit/{id}','UserController@postEdit');
//brand
    Route::get('list','BrandController@getList');
    Route::get('add','BrandController@getAdd');
    Route::get('edit/{id}','BrandController@getEdit');
    Route::get('delete/{id}','BrandController@getDelete');
    Route::post('add','BrandController@postAdd');
    Route::post('edit/{id}','BrandController@postEdit');
//category
    Route::get('list','CategoryController@getList');
    Route::get('add','CategoryController@getAdd');
    Route::get('edit/{id}','CategoryController@getEdit');
    Route::get('delete/{id}','CategoryController@getDelete');
    Route::post('add','CategoryController@postAdd');
    Route::post('edit/{id}','CategoryController@postEdit');
//feature
    Route::get('list','FeatureProductContronller@getList');
    Route::get('add','FeatureProductContronller@getAdd');
    Route::get('delete/{idProduct}','FeatureProductContronller@getDelete');
    Route::post('add','FeatureProductContronller@postAdd');
//latest
    Route::get('list','LatestProductController@getList');
    Route::get('add','LatestProductController@getAdd');
    Route::get('delete/{id}','LatestProductController@getDelete');
    Route::post('add','LatestProductController@postAdd');
//menu
    Route::get('list','MenuController@getList');
    Route::get('add','MenuController@getAdd');
    Route::get('edit/{id}','MenuController@getEdit');
    Route::get('delete/{id}','MenuController@getDelete');
    Route::post('add','MenuController@postAdd');
    Route::get('add/parent/{id}','MenuController@getAddChildMenu');
    Route::post('add/parent/{id}','MenuController@postAddChildMenu');
    Route::post('edit/{id}','MenuController@postEdit');
//offer
    Route::get('list','OfferController@getList');
    Route::get('add','OfferController@getAdd');
    Route::get('edit/{id}','OfferController@getEdit');
    Route::get('delete/{id}','OfferController@getDelete');
    Route::post('add','OfferController@postAdd');
    Route::post('edit/{id}','OfferController@postEdit');
//shipping
    Route::get('list','ShippingController@getList');
    Route::get('add','ShippingController@getAdd');
//tax
    Route::get('list','TaxController@getList');
    Route::get('add','TaxController@getAdd');
    Route::post('add','TaxController@postAdd');
    Route::get('edit/{id}','TaxController@getEdit');
    Route::post('edit/{id}','TaxController@postEdit');
    Route::get('delete/{id}','TaxController@getDelete');
//testimonial
    Route::get('list','TestimonialController@getList');
    Route::get('add','TestimonialController@getAdd');
    Route::get('edit/{id}','TestimonialController@getEdit');
    Route::get('delete/{id}','TestimonialController@getDelete');
    Route::post('add','TestimonialController@postAdd');
    Route::post('edit/{id}','TestimonialController@postEdit');
//size
    Route::get('list','SizeController@getList');
    Route::get('add','SizeController@getAdd');
    Route::get('edit/{id}','SizeController@getEdit');
    Route::get('delete/{id}','SizeController@getDelete');
    Route::post('add','SizeController@postAdd');
    Route::post('edit/{id}','SizeController@postEdit');
//manage product with size
    Route::get('list','ManageController@getList');
    Route::get('add','ManageController@getAdd');
    Route::get('edit/{id}','ManageController@getEdit');
    Route::get('delete/{id}','ManageController@getDelete');
    Route::post('add','ManageController@postAdd');
    Route::post('edit/{id}','ManageController@postEdit');
});
Route::get('view-order/{id}','CheckoutController@getShipping');



