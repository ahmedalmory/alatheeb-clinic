<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $product)
    {
        return $product->render('admin.products.index', ['title' => trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::select(DB::raw("SELECT * FROM category "));
        return view('admin.products.create', ['title' => trans('admin.create'), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'p_name'     => 'required|string',
            'cat_id'    => 'required',
            'p_price' => 'required',
        ];
        $data = $this->validate(request(), $rules, [], [
            'p_name'     => trans('admin.p_name'),
            'cat_id'    => trans('admin.cat_id'),
            'p_price' => trans('admin.p_price'),
        ]);
        Product::create($data);

        session()->flash('success', trans('admin.added'));
        return redirect(aurl('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        return view('admin.products.show', ['title' => trans('admin.show'), 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = DB::select(DB::raw("SELECT * FROM category "));
        return view('admin.products.edit', ['title' => trans('admin.edit'), 'product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'p_name'     => 'required|string',
            'cat_id'    => 'required',
            'p_price' => 'required',
        ];
        $data = $this->validate(request(), $rules, [], [
            'p_name'     => trans('admin.p_name'),
            'cat_id'    => trans('admin.cat_id'),
            'p_price' => trans('admin.p_price'),
        ]);
        $product->update($data);

        session()->flash('success', trans('admin.added'));
        return redirect(aurl('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        @$product->delete();
        session()->flash('success', trans('admin.deleted'));
        return back();
    }

    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $products = Product::find($id);

                @$products->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        } else {
            $products = Product::find($data);

            @$products->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }
}
