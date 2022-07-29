
	<main id="main" class="main-site">
	<style>
		.regprice{
			font-weight:300;
			font-size:13px !important;
			color:#aaaaaa !important;
			text-decoration: line-through;
			padding-left:10px;
		}
	</style>
		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">Trang chủ</a></li>
					<li class="item-link"><span>Giỏ hàng</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
				@if(Cart::instance('cart')->count()>0)
				<div class="wrap-iten-in-cart">
					@if(Session::has('success_message'))
						<div class="alert alert-success">
							{{Session::get('success_message')}}
						</div>
					@endif
					@if(Cart::instance('cart')->count()>0)
					<h3 class="box-title">Tên sản phẩm</h3>
					<ul class="products-cart">
						@foreach(Cart::instance('cart')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
							</div>

							@foreach($item->options as $key=>$value)
								<div style="vertical-align:middle;width:180px;">
									<p><b>{{$key}}: {{$value}}</b></p>
								</div>
							@endforeach

							@if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())  
								<div class="price-field product-price"><p class="regprice">{{ $item->model->regular_price }}vnđ</p></div>                                 
							@else   
								<div class="price-field product-price"><p class="price">{{ $item->model->regular_price }}vnđ</p></div>
							@endif

							
							
							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >									
									<a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
									<a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
								</div>
								<p class="text-center"><a href="#" wire:click.prevent="switchToSaveForLater('{{$item->rowId}}')">Save For Later</a></p>
							</div>
							<div class="price-field sub-total"><p class="price">{{number_format($item->subtotal,3,'.','.')}} vnđ</p></div>
							<div class="delete">
								<a href="#" wire:click.prevent="Destroy('{{$item->rowId}}')" class="btn btn-delete" title="">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
						@endforeach										
					</ul>
					@else
						<p>Không có sản phẩm trong giỏ hàng</p>
					@endif
				</div>

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Thông tin đơn hàng</h4>
						<p class="summary-info"><span class="title">Tổng tiền</span><b class="index">{{(Cart::instance('cart')->subtotal())}} vnđ</b></p>
						@if(Session::has('coupon'))
							<p class="summary-info"><span class="title">Giảm giá ({{Session::get('coupon')['code']}}) <a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i></a></span><b class="index"> -{{number_format($discount,3)}}vnđ</b></p>
							<p class="summary-info"><span class="title">Tổng giảm giá</span><b class="index">{{number_format($subtotalAfterDiscount,3)}}vnđ</b></p>
							<p class="summary-info"><span class="title">Tax ({{config('cart.tax')}}%)</span><b class="index">{{number_format($taxAfterDiscount,2)}}vnđ</b></p>						
							<p class="summary-info total-info "><span class="title">Thành Tiền</span><b class="index">{{number_format($totalAfterDiscount,2)}}vnđ</b></p>
						@else
							<p class="summary-info"><span class="title">Tax</span><b class="index">{{Cart::instance('cart')->tax()}} vnđ</b></p>
							<p class="summary-info"><span class="title">Phí ship</span><b class="index">Miễn phí ship</b></p>
							<p class="summary-info total-info "><span class="title">Thành Tiền</span><b class="index">{{Cart::instance('cart')->total()}} vnđ</b></p>
						@endif
						
					</div>
					<div class="checkout-info">
						@if(!Session::has('coupon'))
						<label class="checkbox-field">
							<input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox" wire:model="haveCouponCode"><span>Tôi có mã giảm giá</span>
						</label>
						@if($haveCouponCode == 1)
							<div class="summary-item">
								<form wire:submit.prevent="applyCouponCode">
									<h4 class="title-box">Mã giảm giá</h4>
									@if(Session::has('coupon_message'))
										<div class="alert alert-danger" role="danger">{{Session::get('coupon_message')}}</div>
									@endif
									<p class="row-in-form">
										<label for="coupon-code">Nhập mã của bạn:</label>
										<input type="text" name="coupon-code" wire:model="couponCode"/>
									</p>
									<button type="submit" class="btn btn-small">Áp dụng</button>
								</form>
							</div>
						@endif
					@endif
						<a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Check out</a>
						<a class="link-to-shop" href="shop.html">Tiếp Tục shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>
					<div class="update-clear">
						<a class="btn btn-clear" href="#" wire:click.prevent="DestroyAll()">Xóa giỏ hàng</a>
						<a class="btn btn-update" href="#">Cập nhật giỏ hàng</a>
					</div>
				</div>
				@else
					<div class="text-center" style="padding:30px 0">
						<h1>Giỏ hàng của bạn trống!</h1>
						<p>Thêm sản phẩm ngay bây giờ</p>
						<a href="/shop" class="btn btn-success">Shop Now</a>
					</div>
				@endif

				<div class="wrap-iten-in-cart">
					<h3 class="title-box" style="border-bottom:1px solid;padding-bottom:15px;">{{Cart::instance('saveForLater')->count()}} item(s) Save For later</h3>
					@if(Session::has('s_success_message'))
						<div class="alert alert-success">
							{{Session::get('s_success_message')}}
						</div>
					@endif
					@if(Cart::instance('saveForLater')->count()>0)
					<h3 class="box-title">Tên sản phẩm</h3>
					<ul class="products-cart">
						@foreach(Cart::instance('saveForLater')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
							</div>

					
								
					
							@if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())  
								<div class="price-field product-price"><p class="regprice">{{ $item->model->regular_price }}vnđ</p></div>                                 
							@else   
								<div class="price-field product-price"><p class="price">{{ $item->model->regular_price }}vnđ</p></div>
							@endif
							<div class="price-field sub-total"><p class="price">{{number_format($item->subtotal,2)}} vnđ</p></div>
							<div class="quantity">								
								<p class="text-center"><a href="#" wire:click.prevent="moveToCart('{{$item->rowId}}')">Move To Cart</a></p>
							</div>
							<div class="delete">
								<a href="#" wire:click.prevent="deleteFromSaveForLater('{{$item->rowId}}')" class="btn btn-delete" title="">
									<span>Xóa sản phẩm khỏi danh sách</span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
						@endforeach										
					</ul>
					@else
						<p>Không có sản phẩm trong danh sách lưu</p>
					@endif
				</div>

				<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">Xem nhiều sản phẩm</h3>
					<div class="wrap-products" wire:ignore>
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
							@foreach($popular_products  as $p_product)
							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="{{route('product.details',['slug'=>$p_product->slug])}}" title="{{$p_product->name}}">
										<figure><img src="{{asset('assets/images/products')}}/{{$p_product->image}}" width="214" height="214" alt="{{$p_product->name}}"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="{{route('product.details',['slug'=>$p_product->slug])}}" class="function-link">quick view</a>
									</div>									
								</div>
								<div class="product-info">
									<a href="{{route('product.details',['slug'=>$p_product->slug])}}" class="product-name"><span>{{$p_product->name}}</span></a>
									<div class="wrap-price"><span class="product-price">{{$p_product->regular_price}} vnđ</span></div>
								</div>
							</div>
							@endforeach
						</div>
					</div><!--End wrap-products-->
				</div>

			</div><!--end main content area-->
		</div><!--end container-->

	</main>
