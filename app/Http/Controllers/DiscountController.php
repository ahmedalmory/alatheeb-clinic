<?php

namespace App\Http\Controllers;

use Ahmedjoda\JodaResources\JodaResource;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    use JodaResource;
    protected $rules = [
        'discount_rate'     =>  'required',
        'show_discount_rate'        =>  'required',
        'start_at'      =>  'required',
        'end_at'        =>  'required',
        'product_id'        =>  'required',
    ];

}
