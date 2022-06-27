@extends('style.index_doctor')
@section('content')
<script>
$(document).ready(function () {
	  layout_1();

	})
	 function layout_1(){
		 $("#layout_1").load("doctor_layout_1");
	 }
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

	 function tahweel_patient(id,appoint_id,doc_current){
        var doc_id = $("#doctors").val();
        var dep_id = $("#dep_id").val();

        if (dep_id === '') {
            $.notify("فضلا اختر العيادة");
            $("#dep_id").focus();
        }
        else if (doc_id === '') {
            $.notify("فضلا اختر دكتور");
            $("#doctors").focus();
        }
       else if(doc_id == doc_current){
		   $.notify("فضلا اختر دكتور غيراسمك");
	   }
        else {

            $.ajax({
                url: 'update_tahveel_patient',
                data: {
                    _token: '{!! csrf_token() !!}',
                    id: id, doc_id: doc_id, dep_id: dep_id,
					appoint_id:appoint_id
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
 function get_detail(id,appoint_id){
                $.ajax({
                    url: 'get_patient_detail',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        id:id,appoint_id:appoint_id
                    },
                    type: 'POST',
                    cache:false,
                    success: function(frm){
                        $("#pat_detail").html(frm);
                    },
                    error: function(xhr){
                        alert(xhr.status+' '+xhr.statusText);
                    }
                });

        };

		 function save_treatment(patient_id,appoint_id){
            var toothArray=[];
            $(".toothArray input:checkbox[name=tooth]:checked").each(function(){
                toothArray.push($(this).val());
                });
			 var treatment = $("#tratment").val();
			 var taken = $("#taken").val();
			 var t_total = $("#t_total").html();
			var p_id_array = new Array();
			$('input[name="p_id[]"]').each(function(){
			p_id_array.push($(this).val());
		});
             var p_cat_array = new Array();
             $('input[name="p_cat[]"]').each(function(){
                 p_cat_array.push($(this).val());
             });
			var p_name_array = new Array();
			$('input[name="p_name[]"]').each(function(){
			p_name_array.push($(this).val());
		});
		var p_price_array = new Array();
			$('input[name="p_price[]"]').each(function(){
			p_price_array.push($(this).val());
		});
                $.ajax({
                    url: 'save_treatment',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        patient_id:patient_id,appoint_id:appoint_id,
						treatment:treatment,taken:taken,t_total:t_total,
						p_id:p_id_array,
						p_cat:p_cat_array,
						p_name:p_name_array,
						p_price:p_price_array,
                        tooth:toothArray
                    },
                    type: 'POST',
                    cache:false,
					dataType: 'json',
                    success: function(data){
						$.notify(data.text, data.cls);
						layout_1();

                        $("#pat_detail").html('<h1>تمت انهاء الجلسة بنجاح</h1>');
                    },
                    error: function(xhr){
                        alert(xhr.status+' '+xhr.statusText);
                    }
                });

        };
		 function add_item_invoice(){
			 var id = $("#product_id").val();
                $.ajax({
                    url: 'invoice_items',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        id:id
                    },
                    type: 'POST',
                    cache:false,
                    success: function(frm){
                       $("#msg").append($("<tr class='txt1' table-condensed>").html(frm));
                    },
                    error: function(xhr){
                        alert(xhr.status+' '+xhr.statusText);
                    }
                });

        };
	    function get_products(){
            var id = $("#cat_id").val();
            $.ajax({
                url: 'get_products',
                data:{
                    _token: '{!! csrf_token() !!}',
                    id:id
                },
                type: 'POST',
                cache:false,
                success: function(frm){
                    $("#product_id").html(frm);
                },
                error: function(xhr){
                    alert(xhr.status+' '+xhr.statusText);
                }
            });
        };
</script>
<div class="clear-fix"></div>
		<div class="row">
        <div class="col-md-12">

<div class="col-md-4" id="layout_1">

</div>
<div class="col-md-8" id="pat_detail">
					<h5 style="margin-top: 20px !important;">{{trans('admin.patient_name')}}: </h5>
					<div class="tab">
					  <button class="tablinks" onclick="openCity(event, 'tashkhees')">{{trans('admin.Current diagnosis')}}</button>
					  <button class="tablinks" onclick="openCity(event, 'isdar')">{{trans('admin.Issuing an invoice')}}</button>
					  <button class="tablinks" onclick="openCity(event, 'bayanat')">{{trans('admin.Patient data')}}</button>
					  <button class="tablinks" onclick="openCity(event, 'sabiqa')">{{trans('admin.previous diagnoses')}}</button>
					  <button class="tablinks" onclick="openCity(event, 'tahveel')">{{trans('admin.Transfer the patient')}}</button>
					</div>

					<div id="tashkhees" class="tabcontent">
					  <h3>{{trans('admin.Please_click_on_the_patients_name')}} </h3>

					</div>

					<div id="isdar" class="tabcontent">
					  <h3>{{trans('admin.Please_click_on_the_patients_name')}} </h3>

					</div>

					<div id="bayanat" class="tabcontent">
					    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

					</div>
					<div id="sabiqa" class="tabcontent">
					    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

					</div>
					<div id="tahveel" class="tabcontent">
					    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

					</div>


        </div><!-- end div 8 -->
        </div><!-- end content -->
          </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->
      </div><!-- end row -->
	<script>
	function openCity(evt, cityName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";
	}
	</script>
	<script>
	function openCity2(evt, cityName) {
	  var i, tabcontent1, tablinks1;
	  tabcontent1 = document.getElementsByClassName("tabcontent1");
	  for (i = 0; i < tabcontent1.length; i++) {
	    tabcontent1[i].style.display = "none";
	  }
	  tablinks1 = document.getElementsByClassName("tablinks1");
	  for (i = 0; i < tablinks1.length; i++) {
	    tablinks1[i].className = tablinks1[i].className.replace(" active", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";
	}
	</script>

<style>

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  margin-top:10px;
  margin-bottom:10px;
}

/* Style the buttons inside the tab */
.tab button , .tab a {
    color: black;
  background-color: inherit;
  float: right;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 8px 12px;
  border-top: 1px solid #ccc !important;
  border-top: none;
}
.tabcontent1 {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
#tashkhees .btn-danger{
    margin: 30px auto;
}
#isdar button.btn.btn-success{
    width: 150px;
    white-space: normal;
    font-size:13px;
}
#tahweel .table.table-bordered{
    margin-top: 8px !important;
}
</style>

@endsection
