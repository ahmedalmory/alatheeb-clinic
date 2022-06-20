<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\Expense_mainDataTable;
use App\Http\Controllers\Controller;
use App\Model\Expenses_main;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;


class Expense_main extends Controller
{

    public function index(Expense_mainDataTable $expense_main)
    {
        return $expense_main->render('style.expenses_main.index', ['title' => trans('admin.expenses_main')]);
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

    public function expense_main_add(){
        return view('style.expenses_main.expensemain_add');
        }
    public function expense_main_edit(Request $request){
        if (Expenses_main::where('id', $request->id)->exists()) {
            $expense_main = DB::select(DB::raw("SELECT 
  * FROM expense_type_main
WHERE id = $request->id"));
           // print_r( $category );
            return view('style.expenses_main.expensemain_edit', compact('expense_main'));
        }
        else { echo "no";}

    }

    function save_expense_main(Request $request)
    {
        $post = new Expenses_main();
        $post->exp_m_name = $request->exp_m_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت حفظ مصرف الرئيسي بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }

    function update_expense_main(Request $request)
    {
        $post = Expenses_main::find($request->id);
        $post->exp_m_name = $request->exp_m_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت تعديل مصرف الرئيسي بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }


}

