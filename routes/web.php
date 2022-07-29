<?php
use App\Http\Middleware\AuthAdmin;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserEditProfileComponent;

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminCouponComonent;
use App\Http\Livewire\Admin\AdminAddCouponComonent;
use App\Http\Livewire\Admin\AdminEditCouponComonent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;
use App\Http\Livewire\Admin\AdminAttributesComponent;
use App\Http\Livewire\Admin\AdminAddAttributesComponent;
use App\Http\Livewire\Admin\AdminEditAttributesComponent;











use Illuminate\Support\Facades\Route;


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

//Route::get('/', function () {
 //   return view('welcome');
//});

Route::get('/',HomeComponent::class);

Route::get('/about',AboutComponent::class);

Route::get('/contact-us',ContactComponent::class)->name('contact');

Route::get('/shop',ShopComponent::class);

Route::get('/checkout',CheckoutComponent::class);

Route::get('/cart',CartComponent::class)->name('product.cart');

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}/{scategory_slug?}',CategoryComponent::class)->name('product.category');

Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');

Route::get('/thank-you',ThankyouComponent::class)->name('thankyou');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//for user or customer
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
    route::get('/user/orders',UserOrdersComponent::class)->name('user.orders');
    route::get('/user/orders/{order_id}',UserOrderDetailsComponent::class)->name('user.orderdetails');
    route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');
    route::get('/user/profile',UserProfileComponent::class)->name('user.profile');
    route::get('/user/profile/edit',UserEditProfileComponent::class)->name('user.editprofile');
}); 
//for admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){
    route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories');
    route::get('/admin/categories/add',AdminAddCategoryComponent::class)->name('admin.addcategory');
    route::get('/admin/categories/edit/{category_slug}/{scategory_slug?}',AdminEditCategoryComponent::class)->name('admin.editcategory');
    route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    route::get('/admin/product/add',AdminAddProductComponent::class)->name('admin.addproduct');
    route::get('/admin/product/edit/{product_slug}',AdminEditProductComponent::class)->name('admin.editproduct');

    route::get('/admin/slider',AdminHomeSliderComponent::class)->name('admin.homeslider');
    route::get('/admin/slider/add',AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    route::get('/admin/slider/edit/{slide_id}',AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    route::get('/admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');
    route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');

    route::get('/admin/coupons',AdminCouponComonent::class)->name('admin.coupons');
    route::get('/admin/coupon/add',AdminAddCouponComonent::class)->name('admin.addcoupon');
    route::get('/admin/coupon/edit/{coupon_id}',AdminEditCouponComonent::class)->name('admin.editcoupon');

    route::get('/admin/orders',AdminOrderComponent::class)->name('admin.orders');
    route::get('/admin/orders/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orderdetails');

    route::get('/admin/contact-us',AdminContactComponent::class)->name('admin.contact');

    route::get('/admin/settings',AdminSettingComponent::class)->name('admin.settings');

    route::get('/admin/attributes',AdminAttributesComponent::class)->name('admin.attributes');
    route::get('/admin/attribute/add',AdminAddAttributesComponent::class)->name('admin.add_attribute');
    route::get('/admin/attribute/edit/{attribute_id}',AdminEditAttributesComponent::class)->name('admin.edit_attribute');
});
