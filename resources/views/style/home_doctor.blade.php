@extends('style.index')

@section('content')
	<div class="homepagetable">

		<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-lg-offset-1">
          <div class="block4">
            <div class="title">{{ trans('admin.search') }} </div>
            <div class="content">

            	@include('style.search')
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>{{ trans('admin.f_number') }}</th>
                      <th>{{ trans('admin.name') }}</th>
                      <th>{{ trans('admin.nationality') }}</th>
                      <th>{{ trans('admin.mobile') }}</th>
                      <th>{{ trans('admin.civil') }}</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($patients as $patient)
                    <tr>
                      <td>{{ $patient->f_number }}</td>
                      <td>{{ $patient->first_name }} {{ $patient->father_name }} {{ $patient->grand_name }}</td>
                      <td>{{ $patient->national->nat_name }}</td>
                      <td>{{ $patient->mobile }}</td>
                      <td>{{ $patient->civil }}</td>
                      <td>@include('style.patients.buttons.actions')</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div><!-- end table-responsive -->
            </div><!-- end content -->
          </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->
      </div><!-- end row -->


		{!! $patients->render() !!}
	</div><!-- end homepagetable -->
    <script>

        function add_file(id){
            $("#status_msg").html('');
            try{

                $("#addcompany").modal("show");
                $.ajax({
                    url: 'file_add',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        id:id
                    },
                    type: 'POST',
                    cache:false,
                    success: function(frm){
                        $("#box").html(frm);
                    },
                    error: function(xhr){
                        $("#box").html(xhr.status+' '+xhr.statusText);
                    }
                });
            }catch(e){
                alert(e.message);
            }
        };
        $(document).ready(function () {
            $("#save_company").on('submit', (function (e) {
                var file_name = $('#file_name').val();
                if(file_name === ''){
                    $.notify("فضلا اكتب اسم الملف");
                    $("#file_name").focus();
                    e.preventDefault();
                }
                else{
                    e.preventDefault();
                    var fd = new FormData(this);
                    $.ajax({
                        url: 'saveFile',
                        data:fd,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token()}}'
                        },
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            $.notify(data.text,data.cls);
                            $('#save_company')[0].reset();
                            $("#file_name").focus();
                        },
                        error: function (xhr) {
                            alert("Error: - " + xhr.status + " " + xhr.statusText);
                        }
                    });
                }

            }));
        })

        function search_patient(id){
            $("#editcompany").modal("show");

            $.ajax({
                url: 'company_edit',
                data:{
                    _token: '{!! csrf_token() !!}',
                    id:id
                },
                type: 'POST',
                cache:false,
                success: function(frm){
                    $("#box_edit").html(frm);

                },
                error: function(xhr){
                    alert('error');
                }
            });


        };

        function tahweel_patient(id){
            var doc_id = $("#doctors").val();
            var dep_id = $("#dep_id").val();
            var visit_date = $("#date_visit").val();
            if (dep_id === '') {
                $.notify("فضلا اختر العيادة");
                $("#dep_id").focus();
            }
            else if (doc_id === '') {
                $.notify("فضلا اختر دكتور");
                $("#doctors").focus();
            }
            else if (visit_date === '') {
                $.notify("فضلا اختر التاريخ");
                $("#date_visit").focus();
            }
            else {

                $.ajax({
                    url: 'save_tahveel_patient',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id, doc_id: doc_id, dep_id: dep_id, visit_date: visit_date
                    },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        $.notify(data.text, data.cls);
                        $('#update_company')[0].reset();
                    },
                    error: function (xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });
            }
        };
        function get_doctors(){
            var id = $("#dep_id").val();
            $.ajax({
                url: 'get_doctors',
                data:{
                    _token: '{!! csrf_token() !!}',
                    id:id
                },
                type: 'POST',
                cache:false,
                success: function(frm){
                    $("#doctors").html(frm);
                },
                error: function(xhr){
                    alert(xhr.status+' '+xhr.statusText);
                }
            });
        };
    </script>
    {!! modelBox("box","addcompany","اضافة ملف","status_msg","save_company") !!}
    {!! modelBox("box_edit","editcompany","تحويل المريض الي طبيب","status_update","update_company") !!}


@endsection
