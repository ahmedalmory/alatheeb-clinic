<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\ExpenseDataTable;
use App\Http\Controllers\Controller;

use App\Model\expense_detail;
use App\Model\expense_main;
use App\Model\Expense_sub;
use App\User;
use Carbon\Carbon;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Expense extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(ExpenseDataTable $expense)
   {

      return $expense->render('style.expense.index', ['title' => trans('admin.expense')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */


   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $invoices = expense_main::find($id);

            @$invoices->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $invoices = exp_main::find($data);

         @$invoices->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }



   public function create_expense(){
       $exp_main = DB::select(DB::raw("SELECT * FROM expense_type_main "));
       $category = DB::select(DB::raw("SELECT * FROM category "));
       return view('style.expense.create_expense',compact('exp_main'));
   }

    //get products based on category
    function get_expense_sub(Request $request)
    {
        if($request->id){
            $expense_sub = DB::select(DB::raw("SELECT * FROM expense_type WHERE exp_m_id = $request->id"));
            echo '<option value="">اختر مصرف الفرعي</option>';
            foreach($expense_sub as $exp_sub){


                echo '<option value="'.$exp_sub->id.'">'.$exp_sub->exp_name.'</option>';
            }
        }

    }

    //invoice items
    function invoice_items_exp(Request $request)
    {
        if (Expense_sub::where('id', $request->id)->exists()) {
            $exp_item = DB::select(DB::raw("SELECT 
  * FROM expense_type
WHERE id = $request->id"));
            $exp_amount = $request->exp_amount;
            return view('style.expense.invoice_items_exp', compact('exp_item','exp_amount'));
        }
        else { echo "Record not found";}


    }

    function save_invoice_exp(Request $request)
    {
        if($request->t_total > 0){
            $post = new expense_main;
            $post->total_amount = $request->t_total;
            $post->user_id = Auth::user()->id;
            $post->in_day = Carbon::now();
            $post->comments = $request->comments;
            $msg = $post->save();
            $id = DB::getPdo()->lastInsertId();
            for ($i = 0; $i < count($request->p_id); $i++) {
                $post = new expense_detail;
                $post->exp_s_id = $request->p_id[$i];
                $post->exp_m_id = $request->p_cat[$i];
                $post->exp_s_name = $request->p_name[$i];
                $post->amount = $request->p_price[$i];
                $post->expense_main_id = $id;
                $msg = $post->save();
            }
            if ($msg) {
                echo json_encode(array('text' => 'تحت حفظ فاتورة المصاريف بنجاح', 'cls' => 'success','status' => '1', 'last_id'=>$id));
            } else {
                echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
            }
        }else{
            echo json_encode(array('text' => 'فضلا اختر واحد من المصاريف الفرعية', 'cls' => 'error'));
        }
    }
   public function invoice_print_expense($id)
    {
        $expense_main = DB::select(DB::raw("SELECT 
  * FROM expense_main
WHERE id = $id"));
        $expense_detail = DB::select(DB::raw("SELECT 
  * FROM expense_detail
WHERE expense_main_id = $id"));
            return view('style.expense.invoice_print_expense',compact('expense_main','expense_detail'));



    }



}
