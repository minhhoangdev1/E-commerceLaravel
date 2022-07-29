<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;

    public $min_price;
    public $max_price;

    public $scategory_slug;


    public function mount($category_slug,$scategory_slug=null)
    {
        $this->sorting="default";
        $this->pagesize=12;
        $this->category_slug=$category_slug;

        $this->min_price=1;
        $this->max_price=1000;

        $this->scategory_slug=$scategory_slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    public function render()
    {
        $category_id=null;
        $category_name="";
        $filter="";

        if($this->scategory_slug)
        {
            $scategory =Subcategory::where('slug',$this->scategory_slug)->first();
            $category_id=$scategory->id;
            $category_name=$scategory->name;
            $filter="sub";
        }
        else
        {
            $category=Category::where('slug',$this->category_slug)->first();
            $category_id=$category->id;
            $category_name=$category->name;
            $filter="";
        }
       
        if($this->sorting=='date')
        {
            $products=Product::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price')
        {
            $products=Product::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price-desc')
        {
            $products=Product::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else
        {
            $products=Product::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }
        
        $categories=Category::all();
        $popular_products=Product::inRandomOrder()->limit(4)->get();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name,'popular_products'=>$popular_products])->layout('layouts.base');
    }
}
