<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;

class AdminCouponComonent extends Component
{
    public function deleteCoupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message','Giảm giá đã được xóa');
    }

    public function render()
    {
        $coupons=Coupon::all();
        return view('livewire.admin.admin-coupon-comonent',['coupons'=>$coupons])->layout('layouts.base');
    }
}
