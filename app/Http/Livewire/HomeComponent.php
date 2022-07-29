<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\HomeCategory;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Sale;
class HomeComponent extends Component
{
    public function render()
    {
        $popular_products=Product::orderBy('created_at','DESC')->get()->take(10);
        $latest_products=Product::orderBy('created_at','ASC')->inRandomOrder()->limit(10)->get();
        $sliders=HomeSlider::where('status',1)->get();
        $category =HomeCategory::find(1);
        $cats=explode(',',$category->sel_categories);
        $categories=Category::whereIn('id',$cats)->get();
        $no_of_products =$category->no_of_products;
        $sproducts=Product::where('sale_price','>',0)->inRandomOrder()->get()->take(10);
        $sale =Sale::find(1);
        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }
        return view('livewire.home-component',['popular_products'=>$popular_products,'latest_products'=>$latest_products,'sliders'=>$sliders,'categories'=>$categories,'no_of_products'=>$no_of_products,'sproducts'=>$sproducts,'sale'=>$sale])->layout('layouts.base');
    }
}
