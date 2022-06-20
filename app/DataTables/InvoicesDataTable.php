<?php
namespace App\DataTables;

use App\Model\Invoice;
//use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

// Auto DataTable By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved [It V 1.0 | https://it.phpanonymous.com]
class InvoicesDataTable extends DataTable
{

   /**
    * Display a listing of the resource.
    * Auto Ajax Method By Baboon Script [It V 1.0 | https://it.phpanonymous.com]
    * @return \Illuminate\Http\Response
    */

   /**
    * Display ajax response.
    * Auto Ajax Method By Baboon Script [It V 1.0 | https://it.phpanonymous.com]
    * @return \Illuminate\Http\JsonResponse
    */
   public function dataTable(DataTables $dataTables, $query)
   {
      return datatables($query)
         ->addColumn('actions', 'admin.invoices.buttons.actions')
         ->addColumn('pay_at', 'admin.invoices.buttons.pay_at')
         ->addColumn('invoice_status', 'admin.invoices.buttons.invoice_status')
         ->addColumn('checkbox', '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
			<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}"> <span></span></label>')
         ->rawColumns(['checkbox', 'show_action', 'actions', 'user', 'date']);
   }

   /**
    * Get the query object to be processed by dataTables.
    * Auto Ajax Method By Baboon Script [It V 1.0 | https://it.phpanonymous.com]
    * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
    */
   public function query()
   {
      return Invoice::query()
         ->with('patient_id')
         ->with('accountant_id')
         ->with('accountant_group_id')
         ->with('dr_id')
         ->with('dr_group_id')
         ->orderBy('id', 'desc')->select('invoices.*');

   }

   /**
    * Optional method if you want to use html builder.
    *[It V 1.0 | https://it.phpanonymous.com]
    * @return \Yajra\Datatables\Html\Builder
    */
   public function html()
   {
      $html = $this->builder()
         ->columns($this->getColumns())
      //->ajax('')
         ->parameters([
            'responsive'   => true,
            'dom'          => 'Blfrtip',
            "lengthMenu"   => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('admin.all_records')]],
            'buttons'      => [
               ['extend' => 'print', 'className' => 'btn dark btn-outline', 'text' => '<i class="fa fa-print"></i> ' . trans('admin.print')],
               ['extend' => 'excel', 'className' => 'btn green btn-outline', 'text' => '<i class="fa fa-file-excel-o"> </i> ' . trans('admin.export_excel')],
               /*['extend' => 'pdf', 'className' => 'btn red btn-outline', 'text' => '<i class="fa fa-file-pdf-o"> </i> '.trans('admin.export_pdf')],*/
               ['extend' => 'csv', 'className' => 'btn purple btn-outline', 'text' => '<i class="fa fa-file-excel-o"> </i> ' . trans('admin.export_csv')],
               ['extend' => 'reload', 'className' => 'btn blue btn-outline', 'text' => '<i class="fa fa fa-refresh"></i> ' . trans('admin.reload')],
               [
                  'text'      => '<i class="fa fa-trash"></i> ' . trans('admin.delete'),
                  'className' => 'btn red btn-outline deleteBtn',
               ], [
                  'text'      => '<i class="fa fa-plus"></i> ' . trans('admin.add'),
                  'className' => 'btn btn-primary',
                  'action'    => 'function(){
                        	window.location.href =  "' . \URL::current() . '/create";
                        }',
               ],
            ],
            'initComplete' => "function () {
                this.api().columns([]).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).attr( 'style', 'width: 100%');
                $(input).attr( 'class', 'form-control');
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
            }",
            'order'        => [[1, 'desc']],

            'language'     => [
               'sProcessing'     => trans('admin.sProcessing'),
               'sLengthMenu'     => trans('admin.sLengthMenu'),
               'sZeroRecords'    => trans('admin.sZeroRecords'),
               'sEmptyTable'     => trans('admin.sEmptyTable'),
               'sInfo'           => trans('admin.sInfo'),
               'sInfoEmpty'      => trans('admin.sInfoEmpty'),
               'sInfoFiltered'   => trans('admin.sInfoFiltered'),
               'sInfoPostFix'    => trans('admin.sInfoPostFix'),
               'sSearch'         => trans('admin.sSearch'),
               'sUrl'            => trans('admin.sUrl'),
               'sInfoThousands'  => trans('admin.sInfoThousands'),
               'sLoadingRecords' => trans('admin.sLoadingRecords'),
               'oPaginate'       => [
                  'sFirst'    => trans('admin.sFirst'),
                  'sLast'     => trans('admin.sLast'),
                  'sNext'     => trans('admin.sNext'),
                  'sPrevious' => trans('admin.sPrevious'),
               ],
               'oAria'           => [
                  'sSortAscending'  => trans('admin.sSortAscending'),
                  'sSortDescending' => trans('admin.sSortDescending'),
               ],
            ],
         ]);

      return $html;

   }

   /**
    * Get columns.
    * Auto getColumns Method By Baboon Script [It V 1.0 | https://it.phpanonymous.com]
    * @return array
    */

   protected function getColumns()
   {
      return [
         [
            'name'       => 'checkbox',
            'data'       => 'checkbox',
            'title'      => '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                  <input type="checkbox" class="select-all" onclick="select_all()" >
                  <span></span></label>',
            'orderable'  => false,
            'searchable' => false,
            'exportable' => false,
            'printable'  => false,
            'width'      => '10px',
            'aaSorting'  => 'none',
         ],
         [
            'name'  => 'patient_id.first_name',
            'data'  => 'patient_id.first_name',
            'title' => trans('admin.patient_id'),
         ],
         [
            'name'  => 'dr_id.name',
            'data'  => 'dr_id.name',
            'title' => trans('admin.dr_id'),
         ],
         [
            'name'  => 'accountant_id.name',
            'data'  => 'accountant_id.name',
            'title' => trans('admin.accountant_id'),
         ],
         [
            'name'  => 'invoice_date',
            'data'  => 'invoice_date',
            'title' => trans('admin.invoice_date'),
         ],
         [
            'name'  => 'dr_group_id.group_name',
            'data'  => 'dr_group_id.group_name',
            'title' => trans('admin.dr_group_id'),
         ],
         [
            'name'  => 'accountant_group_id.group_name',
            'data'  => 'accountant_group_id.group_name',
            'title' => trans('admin.accountant_group_id'),
         ], [
            'name'  => 'pay_at',
            'data'  => 'pay_at',
            'title' => trans('admin.pay_at'),
         ], [
            'name'  => 'invoice_status',
            'data'  => 'invoice_status',
            'title' => trans('admin.invoice_status'),
         ],
         [
            'name'       => 'actions',
            'data'       => 'actions',
            'title'      => trans('admin.actions'),
            'exportable' => false,
            'printable'  => false,
            'searchable' => false,
            'orderable'  => false,
         ],
      ];
   }

   /**
    * Get filename for export.
    * Auto filename Method By Baboon Script
    * @return string
    */
   protected function filename()
   {
      return 'invoices_' . time();
   }

}
