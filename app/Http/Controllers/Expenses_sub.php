<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\Expense_subDataTable;
use App\Http\Controllers\Controller;
use App\Models\Expense_sub;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;


class Expenses_sub extends Controller
{

    public function index(Expense_subDataTable $expense_sub)
    {
        return $expense_sub->render('style.expense_sub.index', ['title' => trans('admin.expenses_sub')]);
    }

    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $diagnosis = Expense_sub::find($id);

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

    public function expense_sub_add(){
        $exp_main = DB::select(DB::raw("SELECT * FROM expense_type_main "));
        return view('style.expense_sub.expense_sub_add',compact('exp_main'));
        }
    public function expense_sub_edit(Request $request){
        if (Expense_sub::where('id', $request->id)->exists()) {
            $exp_sub = DB::select(DB::raw("SELECT 
  * FROM expense_type
    WHERE id = $request->id"));
            $exp_main = DB::select(DB::raw("SELECT * FROM expense_type_main "));

            return view('style.expense_sub.expense_sub_edit', compact('exp_sub','exp_main'));
        }
        else { echo "no";}

    }

    function save_expense_sub(Request $request)
    {
        $post = new Expense_sub;
        $post->exp_m_id = $request->exp_m_id;
        $post->exp_name = $request->exp_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت حفظ مصرف الفرعي بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }

    function update_expense_sub(Request $request)
    {
        $post = Expense_sub::find($request->id);
        $post->exp_m_id = $request->exp_m_id;
        $post->exp_name = $request->exp_name;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت تعديل مصرف الفرعي بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }


}

