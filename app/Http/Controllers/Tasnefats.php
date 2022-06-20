<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\TasnefatDataTable;
use App\Http\Controllers\Controller;
use App\Model\Tasnefat;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;


class Tasnefats extends Controller
{

    public function index(TasnefatDataTable $tasnefat)
    {
        return $tasnefat->render('style.tasnefat.index', ['title' => trans('admin.category')]);
    }

    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $diagnosis = Tasnefat::find($id);

                @$diagnosis->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        } else {
            $diagnosis = Tasnefat::find($data);

            @$diagnosis->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }

    public function category_add(){
        return view('style.tasnefat.category_add');
        }
    public function category_edit(Request $request){
        if (Tasnefat::where('id', $request->id)->exists()) {
            $category = DB::select(DB::raw("SELECT
  * FROM category
WHERE id = $request->id"));
           // print_r( $category );
            return view('style.tasnefat.category_edit', compact('category'));
        }
        else { echo "no";}

    }

    function save_category(Request $request)
    {
        $post = new Tasnefat;
        $post->cat_name = $request->cat_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت حفظ التصنيف بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }

    function update_category(Request $request)
    {
        $post = Tasnefat::find($request->id);
        $post->cat_name = $request->cat_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت تعديل التصنيف بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }
    public function destroy($id){
        Tasnefat::query()->find($id)->delete();
        return back()->withSuccess('تم الحذف بنجاح');
    }


}

