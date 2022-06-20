<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;


class Products extends Controller
{

    public function index(ProductDataTable $product)
    {
        return $product->render('style.products.index', ['title' => trans('admin.products')]);
    }

    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $diagnosis = Product::find($id);

                @$diagnosis->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        } else {
            $diagnosis = Product::find($data);

            @$diagnosis->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }

    public function product_add(){
        $category = DB::select(DB::raw("SELECT * FROM category "));
        return view('style.products.product_add',compact('category'));
        }
    public function product_edit(Request $request){
        if (Product::where('id', $request->id)->exists()) {
            $product = DB::select(DB::raw("SELECT 
  * FROM product
    WHERE id = $request->id"));
            $category = DB::select(DB::raw("SELECT * FROM category "));

            return view('style.products.product_edit', compact('product','category'));
        }
        else { echo "no";}

    }

    function save_product(Request $request)
    {
        $post = new Product;
        $post->cat_id = $request->cat_id;
        $post->p_name = $request->product_name;
        $post->p_price = $request->product_price;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت حفظ الخدمة بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }

    function update_product(Request $request)
    {
        $post = Product::find($request->id);
        $post->cat_id = $request->cat_id;
        $post->p_name = $request->product_name;
        $post->p_price = $request->product_price;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت تعديل الخدمة بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }


}

