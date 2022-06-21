@extends('admin.index')
@section('content')
<?php
$tmpid = old('tmpid') ? old('tmpid') : rand(00000, 999999);
?>

@push('js')
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change','#gender',function(){
		var gender = $('#gender option:selected').val();
		if(gender == 'female')
		{
			$('.pregnant').removeClass('hidden');
		}else{
			$('.pregnant').addClass('hidden');
		}
	});


 @if(old('gender') == 'female')
		$('.pregnant').removeClass('hidden');
 @endif

	$(document).on('change','#taking_drugs',function(){
		var taking_drugs = $('#taking_drugs option:selected').val();
		if(taking_drugs == 'yes')
		{
			$('.drugs_names').removeClass('hidden');
		}else{
			$('.drugs_names').addClass('hidden');
		}
	});


 @if(old('taking_drugs') == 'yes')
		$('.drugs_names').removeClass('hidden');
 @endif
});

</script>
<style type="text/css">
.form-group{
	padding:15px;
}
</style>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$("div#my-awesome-dropzone").dropzone({
		dictRemoveFile :"{{ trans('admin.delete') }}",
		dictDefaultMessage :"{{ trans('admin.drop_here') }}",
		dictFallbackMessage :"Your browser does not support drag'n'drop file uploads.",
		dictFallbackText :"Please use the fallback form below to upload your files like in the olden days.",
		dictFileTooBig :"{{ trans('admin.big_size_file') }} (@{{filesize}}MiB). {{ trans('admin.max_file_size') }}: @{{maxFilesize}}MiB.",
		dictInvalidFileType :"{{ trans('admin.cant_upload_type') }}.",
		dictResponseError :"Server responded with @{{statusCode}} code.",
		dictCancelUpload :"{{ trans('admin.cancel_upload') }}",
		dictCancelUploadConfirmation :"{{ trans('admin.sure_to_cancel_this_upload') }}",
		dictMaxFilesExceeded :"{{ trans('admin.you_cant_upload_anymore') }}.",
		autoDiscover:false,
  	  addRemoveLinks: true,
  	  removedfile: function(file) {
		  var fid = file.fid;

		  $.ajax({
		   type: 'POST',
		   url: '{{ aurl('delete/file') }}',
		   data: {fid: fid,_token:'{{ csrf_token() }}',tmpid:"{{ $tmpid }}"},
		   sucess: function(data){
		   // console.log('success: ' + data);
		   }
		  });

		  var _ref;
		  return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		 },
  	  maxFiles: 20,
	 url: "{{ aurl('file/upload') }}",
		 params:{
		 	_token:'{{ csrf_token() }}',tmpid:'{{ $tmpid }}'
		},init: function () {

	 	@foreach(App\Files::where('type_file','patient')->where('type_id',$tmpid)->get() as $file)
            var mockFile = { name: "{{ $file->name }}" ,fid: "{{ $file->id }}", size: '{{ $file->size_bytes }}', type: '{{ $file->mimtype }}'  };
            	this.emit('addedfile', mockFile);
            	@if(preg_match('/image/i',$file->mimtype))
                this.options.thumbnail.call(this, mockFile, "{{ it()->url($file->full_path) }}");
                @elseif(preg_match('/audio|video/i',$file->mimtype))
                this.options.thumbnail.call(this, mockFile,"http://icons.iconarchive.com/icons/ahdesign91/media-player/512/WMP-icon.png");
                @elseif(preg_match('/pdf/i',$file->mimtype))
                this.options.thumbnail.call(this, mockFile, "http://icons.iconarchive.com/icons/trayse101/basic-filetypes-2/256/pdf-icon.png");
                @endif
        @endforeach


             this.on("sending", function(file, xhr, formData){
		            formData.append("fid", '');
		            file.fid='';
		      }),



		        this.on('thumbnail', function(file, dataUrl) {
			        var thumbs = document.querySelectorAll('.dz-image');
			        [].forEach.call(thumbs, function (thumb) {
			            var img = thumb.querySelector('img');
			            if (img) {
			                img.setAttribute('width', '150px');
			                img.setAttribute('height', '150px');
			            }
			            thumb.style = 'width: 100%; height: 100%;';
			        });
			    }),

			    this.on('success', function(file,response) {
			    		file.fid = response.id;
			        var thumbs = document.querySelectorAll('.dz-image');
			        [].forEach.call(thumbs, function (thumb) {
			        	 var img = thumb.querySelector('img');
			            if (img) {
			                img.setAttribute('width', '150px');
			                img.setAttribute('height', '150px');
			            }
			            thumb.style = 'width: 100%; height: 100%;';
			        });
			    });

			    $('.dz-image img').css('width','100px');
                $('.dz-image img').css('height','100px');
                $('.dz-progress').remove();
            },
	  maxFilesize: 50, // MB
	  acceptedFiles:'image/*,application/pdf,.psd,video/*,audio/*',
	});
</script>


<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep(old('dep_id')) !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow" ]
  });

});

 $('#jstree').on('changed.jstree',function(e,data){
    var i , j , r = [];
    for(i=0,j = data.selected.length;i < j;i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.dep_id').val(r.join(', '));
});

</script>
@endpush
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
				<div class="actions">
					<a  href="{{aurl('patients')}}"
						class="btn btn-circle btn-icon-only btn-default"
						tooltip="{{trans('admin.show_all')}}"
						title="{{trans('admin.show_all')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen"
						href="#"
						data-original-title="{{trans('admin.fullscreen')}}"
						title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
					{!! Form::open(['url'=>aurl('/patients'),'id'=>'patients','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

				    <div class="clearfix"></div>
				    <h2>{{ trans('admin.dep_id') }}</h2>
                    <div id="jstree"></div>
                    <input type="hidden" name="dep_id" class="dep_id" value="{{ old('dep_id') }}">
                    <div class="clearfix"></div>

					<div class="form-group col-md-4">
						{!! Form::label('f_number',trans('admin.f_number'),['class'=>'c control-label']) !!}
						<div class="">
							{!! Form::text('f_number',old('f_number'),['class'=>'form-control','placeholder'=>trans('admin.f_number')]) !!}
						</div>
					</div>
					<div class="form-group col-md-4">
						{!! Form::label('record_date',trans('admin.record_date'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('record_date',!old('record_date')?date('Y-m-d'):old('record_date'),['class'=>'form-control date-picker','placeholder'=>trans('admin.record_date'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
						</div>
					</div>
					<div class="form-group col-md-4">
						{!! Form::label('civil',trans('admin.civil'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('civil',old('civil'),['class'=>'form-control','placeholder'=>trans('admin.civil')]) !!}
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-3">
						{!! Form::label('first_name',trans('admin.first_name'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('first_name',old('first_name'),['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
						</div>
					</div>
					<div class="form-group col-md-3">
						{!! Form::label('father_name',trans('admin.father_name'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('father_name',old('father_name'),['class'=>'form-control','placeholder'=>trans('admin.father_name')]) !!}
						</div>
					</div>
					<div class="form-group col-md-3">
						{!! Form::label('grand_name',trans('admin.grand_name'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('grand_name',old('grand_name'),['class'=>'form-control','placeholder'=>trans('admin.grand_name')]) !!}
						</div>
					</div>
					<div class="form-group col-md-3">
						{!! Form::label('title',trans('admin.title'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>trans('admin.title')]) !!}
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-3">
						{!! Form::label('relation_id',trans('admin.relation_id'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('relation_id',App\Models\Relationship::pluck('re_name','id'),old('relation_id'),['class'=>'form-control','placeholder'=>trans('admin.relation_id')]) !!}
						</div>
					</div>


					<div class="form-group col-md-3">
						{!! Form::label('gender',trans('admin.gender'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female'),],old('gender'),['class'=>'form-control','placeholder'=>trans('admin.gender')]) !!}
						</div>
					</div>
					<div class="form-group col-md-3 pregnant hidden">
						{!! Form::label('pregnant',trans('admin.pregnant'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('pregnant',['yes'=>trans('admin.yes'),'no'=>trans('admin.no'),],old('pregnant'),['class'=>'form-control','placeholder'=>'..........']) !!}
						</div>
					</div>
					<div class="form-group col-md-3">
						{!! Form::label('nationality',trans('admin.nationality'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('nationality',App\Models\Nationalities::pluck('nat_name','id'),old('nationality'),['class'=>'form-control','placeholder'=>trans('admin.nationality')]) !!}
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-6">
						{!! Form::label('date_birh_hijri',trans('admin.date_birh_hijri'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('date_birh_hijri',old('date_birh_hijri'),['class'=>'form-control hijri','readonly'=>'','placeholder'=>trans('admin.date_birh_hijri')]) !!}
						</div>
					</div>
					<div class="form-group col-md-6">
						{!! Form::label('age',trans('admin.age'),['class'=>'col-md-3 control-label']) !!}
						<div class="">
							{!! Form::text('age',old('age'),['class'=>'form-control age','readonly'=>'','placeholder'=>trans('admin.age')]) !!}
							<small style="color:#c33">هذا هو العمر التقريبى سيتم حسابه بدقة عند عملية الحفظ </small>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-6">
						{!! Form::label('mobile',trans('admin.mobile'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::text('mobile',old('mobile'),['class'=>'form-control','placeholder'=>trans('admin.mobile')]) !!}
						</div>
					</div>
					<div class="form-group col-md-6">
						{!! Form::label('phone',trans('admin.phone'),['class'=>' control-label']) !!}
						<div class="">
							{!! Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>trans('admin.phone')]) !!}
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						{!! Form::label('mobile_nearby',trans('admin.mobile_nearby'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::textarea('mobile_nearby',old('mobile_nearby'),['class'=>'form-control','placeholder'=>trans('admin.mobile_nearby')]) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('comments',trans('admin.comments'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::textarea('comments',old('comments'),['class'=>'form-control','placeholder'=>trans('admin.comments')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group  col-md-6">
						{!! Form::label('purpose_visit',trans('admin.purpose_visit'),['class'=>' control-label']) !!}
						<div class="">
							{!! Form::textarea('purpose_visit',old('purpose_visit'),['class'=>'form-control','placeholder'=>trans('admin.purpose_visit')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group  col-md-6">
						{!! Form::label('sensitivity_penicillin',trans('admin.sensitivity_penicillin'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('sensitivity_penicillin',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('sensitivity_penicillin'),['class'=>'form-control','placeholder'=>'...............']) !!}
						</div>
					</div>

					<div class="form-group  col-md-6">
						{!! Form::label('teeth_medicine',trans('admin.teeth_medicine'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('teeth_medicine',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('teeth_medicine'),['class'=>'form-control','placeholder'=>'...............']) !!}
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="form-group col-md-6">
						{!! Form::label('taking_drugs',trans('admin.taking_drugs'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::select('taking_drugs',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('taking_drugs'),['class'=>'form-control','placeholder'=>'...............']) !!}
						</div>
					</div>

					<div class="form-group col-md-6 drugs_names hidden">
						{!! Form::label('drugs_names',trans('admin.drugs_names'),['class'=>'control-label']) !!}
						<div class="">
							{!! Form::textarea('drugs_names',old('drugs_names'),['class'=>'form-control','placeholder'=>'...............']) !!}
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="col-md-12">
						<center><h1>{{ trans('admin.group_questions') }}</h1></center>
						<div class="form-group col-md-6">
							{!! Form::label('heart_disease',trans('admin.heart_disease'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('heart_disease',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('heart_disease'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('high_low_blood',trans('admin.high_low_blood'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('high_low_blood',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('high_low_blood'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('rheumatic_fever',trans('admin.rheumatic_fever'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('rheumatic_fever',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('rheumatic_fever'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('anemia',trans('admin.anemia'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('anemia',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('anemia'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('thyroid_disease',trans('admin.thyroid_disease'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('thyroid_disease',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('thyroid_disease'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('hepatitis',trans('admin.hepatitis'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('hepatitis',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('hepatitis'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('diabetes',trans('admin.diabetes'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('diabetes',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('diabetes'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('asthma',trans('admin.asthma'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('asthma',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('asthma'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('kidney_disease',trans('admin.kidney_disease'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('kidney_disease',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('kidney_disease'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('tics',trans('admin.tics'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::select('tics',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('tics'),['class'=>'form-control','placeholder'=>'...............']) !!}
							</div>
						</div>
						<div class="form-group col-md-12">
							{!! Form::label('other_diseases',trans('admin.other_diseases'),['class'=>'control-label']) !!}
							<div class="">
								{!! Form::textarea('other_diseases',old('other_diseases'),['class'=>'form-control','placeholder'=>trans('admin.other_diseases')]) !!}
							</div>
						</div>
					</div>
					<br>

						<div class="clearfix"></div>
					<input type="hidden" name="tmpid" value="{{ $tmpid }}">
					<div  class="dropzone hidden" id="my-awesome-dropzone"></div>
					<div class="clearfix"></div>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@stop