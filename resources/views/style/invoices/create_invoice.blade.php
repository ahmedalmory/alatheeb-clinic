@extends('style.index')
@section('content')
    @push('js')
        <script>
            function get_doctors() {
                var id = $("#dep_id").val();
                $.ajax({
                    url: 'get_doctors',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        $("#doctors").html(frm);
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });
            };

            function add_item_invoice() {
                var id = $("#product_id").val();

                $.ajax({
                    url: 'invoice_items_inv',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        $("#msg").append($("<tr class='txt1' table-condensed>").html(frm));
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });

            };

            function get_products() {
                var id = $("#cat_id").val();
                if (id === "") {
                    $("#cash_hand").prop('disabled', true);
                    $("#cash_card").prop('disabled', true);
                    return;
                }
                $.ajax({
                    url: 'get_products',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        $("#product_id").html(frm);
                        $("#cash_hand").prop('disabled', false);
                        $("#cash_card").prop('disabled', false);
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });
            };

            function get_patient() {
                var id = $("#pat_id").val();
                $.ajax({
                    url: 'get_patient_detail_invoice',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        if (frm == 'no') {
                            $("#pat_id").focus;
                            $.notify("رقم ملف المريض غير مسجل", 'warn');
                            $("#pat_name").val('');
                            $("#pat_mobile").val('');
                        } else {
                            $("#pat_detail").html(frm);
                            $("#cat_id").focus;
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });

            };

            function get_due() {
                var cash_hand = $("#cash_hand").val();
                var cash_card = $("#cash_card").val();
                var t_toal = parseInt($("#t_total").html());
                $("#due").html(t_toal - cash_hand - cash_card);

            }

            function save_invoice() {
                var dep_id = $("#dep_id").val();
                var doc_id = $("#doctors").val();
                var patient_id = $("#pat_id2").val();
                var t_total = $("#t_total").html();
                var t_discount = $("#t_discount").html();
                var tax_amount = $("#t_tax_amount").html();
                var cash_hand = $("#cash_hand").val();
                var cash_card = $("#cash_card").val();
                var comments = $("#comments").val();
                var others = $("#other").val();
                var period = $("#period").val();
                var due = $("#due").html();
                var pat_name = $("#pat_name").val();

                var p_id_array = new Array();
                $('input[name="p_id[]"]').each(function() {
                    p_id_array.push($(this).val());
                });

                var p_cat_array = new Array();
                $('input[name="p_cat[]"]').each(function() {
                    p_cat_array.push($(this).val());
                });

                var p_name_array = new Array();
                $('input[name="p_name[]"]').each(function() {
                    p_name_array.push($(this).val());
                });

                var p_price_array = new Array();
                $('input[name="p_price[]"]').each(function() {
                    p_price_array.push($(this).val());
                });

                if (dep_id === '') {
                    $.notify("فضلا اختر العيادة");
                    $("#dep_id").focus();
                } else if (doc_id === '') {
                    $.notify("فضلا اختر دكتور");
                    $("#doctors").focus();
                } else if (period === '') {
                    $.notify("فضلا اختر فترة");
                    $("#period").focus();
                } else if (patient_id === '') {
                    $.notify("فضلا اختر المريض");
                    $("#pat_id").focus();
                } else if (pat_name === '') {
                    $.notify("فضلا اكتب رقم ملف المريض المسجل");
                    $("#pat_id").focus();
                } else {
                    $.ajax({
                        url: 'save_invoice',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            patient_id: patient_id,
                            dep_id: dep_id,
                            doc_id: doc_id,
                            cash_hand: cash_hand,
                            cash_card: cash_card,
                            due: due,
                            t_total: t_total,
                            p_id: p_id_array,
                            p_cat: p_cat_array,
                            p_name: p_name_array,
                            p_price: p_price_array,
                            comments: comments,
                            period: period,
                            other: others,
                            tax_amount: tax_amount,
                            discount_amount: t_discount,
                        },
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            $.notify(data.text, data.cls);
                            if (data.status == '1') {
                                $("#print_invoice").css("visibility", "visible");
                                $("#save_invoice").css("visibility", "hidden");
                                $("#print_invoice").prop("href", "invoice_print/" + data.last_id);
                                location.replace("{{ url('/invoices') }}");
                                // print_invoice(data.last_id);
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.status + ' ' + xhr.statusText);
                        }
                    });
                }
            };
            @if (request()->patient_id)
                get_patient();
            @endif
        </script>
        <style>
            .coodek-mg {
                margin: 8px auto;
            }

        </style>
    @endpush
    <div class="datespage">
        <div class="title">اصدار فاتورة</div>
        <div class="content">
            @if (setting()->tax_enabled)
                <p class="text-danger">
                    هناك نسبة
                    {{ setting()->tax_rate }}% ضريبة علي الفاتورة
                </p>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="clearfix"></div>
                        <div class="col-md-4" style="margin-bottom:10px">

                 {{__('admin.patient_file_number')}}           <input type="text" class="form-control" id="pat_id" name="pat_id"
                                value="{{ request('patient_id', '') }}" onchange="get_patient()">
                        </div>
                        <div id="pat_detail">
                            <div class="col-md-4" style="margin-bottom:10px">
                                {{__('admin.disease_name')}}
                                <input type="text" class="form-control" id="pat_name" name="pat_name" disabled>
                            </div>
                            <div class="col-md-4" style="margin-bottom:10px">
                                {{__('admin.mobile')}}
                                <input type="text" class="form-control" id="pat_mobile" name="pat_mobile" disabled>
                            </div>


                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4" style="margin-bottom:10px">
                            {{__("admin.clinic")}}
                            <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                                <option value="">{{__('admin.select_clinic')}}</option>
                                @foreach ($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom:10px">
                            {{__('app.doctor')}}
                            <select class="form-control" id="doctors">

                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom:10px">
                            {{__('app.period')}}
                            <select class="form-control" id="period">
                                <option value="">{{__('app.choose_period')}}</option>
                                <option value="morning">{{__('admin.morning')}}</option>
                                <option value="evening">{{__('admin.evening')}}</option>

                            </select>
                        </div>

                        <div class="col-md-4" style="margin-bottom:10px">
                            {{__('app.categories')}} :
                            <select class="form-control" id="cat_id" name="cat_id" onchange="get_products()">
                                <option value="">{{__('app.select_category')}} :</option>
                                @foreach ($category as $cat)
                                    @php($id = $cat->id)
                                    @if (canDo(auth()->id(), 'categories', $id))
                                        <option value="{{ $cat->id }}">{{ $cat->cat_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom:10px">
                            {{__('admin.product')}} :
                            <select class="form-control" id="product_id" onchange="add_item_invoice()">

                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom:10px">

                        @if (setting()->tax_enabled)
                            <div class="row coodek-mg">
                                <div class="row coodek-mg">
                                    <div class="col-md-5">
                                        {{__('app.total_with_tax')}} :
                                    </div>
                                    <div class="col-md-7">
                                        <center> <span class="form-control" id="t_total">0</span></center>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                  {{__('app.tax_value')}} :
                                </div>
                                <div class="col-md-7">
                                    <center> <span class="form-control" id="t_tax_amount">0</span></center>

                                </div>
                            </div>
                        @else
                            <div class="row coodek-mg">
                                <div class="col-md-5">
                                    {{__('app.total')}} :
                                </div>
                                <div class="col-md-7">
                                    <center> <span class="form-control" id="t_total">0</span></center>
                                </div>
                            </div>
                        @endif
                        <div class="row coodek-mg">
                            <div class="col-md-5">
                                {{__('app.total_discount')}} :
                            </div>
                            <div class="col-md-7">
                                <center> <span class="form-control" id="t_discount">0</span></center>
                            </div>
                        </div>
                        <div class="row coodek-mg">
                            <div class="col-md-5">
                                {{__('app.paid_in_cash')}} :
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="cash_hand" onkeyup="get_due();" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row coodek-mg">
                            <div class="col-md-5">

                                {{__('app.paid_in_internet')}} :
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="cash_card" onkeyup="get_due();" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row coodek-mg">
                            <div class="col-md-5">
                                {{__('app.rest')}} :
                            </div>
                            <div class="col-md-7">
                                <center>
                                    <span id="due" class="form-control">0</span>
                                </center>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 coodek-mg">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{__('admin.cat_name')}}</th>
                                <th>{{__('admin.product_name')}}</th>
                                <th>{{__('app.price')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="msg">

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="100">
                                    <textarea placeholder="{{__("app.Invoice_notes")}}" id="comments" class="form-control"></textarea>
                                </td>
                                <!-- <td colspan="2">
                            <textarea placeholder="التصنيف آخرى" id="other" class="form-control"></textarea>
                        </td> -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-6 coodek-mg">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-success btn-block" target="_blank" style="visibility:hidden;"
                            id="print_invoice">{{__('app.print')}} </a>
                    </div>
                </div>
                <div class="col-md-6 coodek-mg">

                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8 ">
                        <button class="btn btn-success btn-block" style="visibility:visible;" id="save_invoice"
                            onclick="save_invoice();">{{__('app.add_invoice')}} </button>

                        <!-- <a href="{{ url('create_invoice') }}" class="btn btn-primary btn-block"  >فاتورة جديده</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
