<?php
namespace App\Models;
use App\Discount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Product extends Model {

protected $table    = 'product';
protected $fillable = [
		'id',
		'p_name',
		'cat_id',
    'p_price',

    'created_at',
		'updated_at',
	];

    public function cat_id()
    {
        return $this->hasOne(\App\Models\Tasnefat::class, 'id', 'cat_id');
    }
    public function totalDiscountAmount(){
        $discounts = Discount::query()
            ->whereDate('start_at','<=',Carbon::today()->toDateString())
            ->whereDate('end_at','>=',Carbon::today()->toDateString())
            ->get();
        $product = $this;
        $discounts = $discounts->filter(function ($item) use($product){
            return $item->product_id == $product->id or $item->product_id == 0;
        });
        return $discounts->sum("discount_rate");
    }

}
