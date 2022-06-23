@extends('style.index')
@section('content')
    @push('js')
        <script type="text/javascript">
            $(document).ready(function() {


                $(document).on('change', '.gender', function() {
                    var gender = $('.gender option:selected').val();
                    if (gender == 'female') {
                        $('.pregnant').removeClass('hidden');
                    } else {
                        $('.pregnant').addClass('hidden');
                    }
                });


                @if (old('gender') == 'female')
                    $('.pregnant').removeClass('hidden');
                @endif


                $(document).on('change', '#taking_drugs', function() {
                    var taking_drugs = $("#patients input[type='radio'][name='taking_drugs']:checked").val();

                    if (taking_drugs == 'yes') {
                        $('.drugs_names').removeClass('hidden');
                    } else {
                        $('.drugs_names').addClass('hidden');
                    }
                });

                @if (old('taking_drugs') == 'yes')
                    $('.drugs_names').removeClass('hidden');
                @endif
            });

            function get_doctors() {
                var id = $("#dep_id").val();
                $.ajax({
                    url: '../get_doctors',
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

            function tahweel_patient(id) {
                var doc_id = $("#doctors").val();
                var dep_id = $("#dep_id").val();
                if (dep_id === '') {
                    $.notify("{{ __('app.please_choose_department') }}");
                    $("#dep_id").focus();
                } else if (doc_id === '') {
                    $.notify("{{ __('app.please_choose_doctor') }}");
                    $("#doctors").focus();
                } else {

                    $.ajax({
                        url: '../save_tahveel_patient',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id: id,
                            doc_id: doc_id,
                            dep_id: dep_id
                        },
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        success: function(data) {
                            $.notify(data.text, data.cls);
                            $('#update_company')[0].reset();
                        },
                        error: function(xhr) {
                            alert(xhr.status + ' ' + xhr.statusText);
                        }
                    });
                }
            };

            function search_patient() {
                var id = $("#civil").val();
                var type = "idn";
                if (id.length != 10) {
                    $.notify("{{ __('app.id_number_should_be_10_digits') }}");
                    $("#civil").focus();
                    // $("#first_name").prop("disabled", true);
                    // $("#record_date").prop("disabled", true);
                    // $("#image").prop("disabled", true);
                    // $("#date_birh_hijri").prop("disabled", true);
                    // $("#age").prop("disabled", true);
                    // $("#gender").prop("disabled", true);
                } else {
                    $.ajax({
                        url: '../company_edit',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id: id,
                            type: type
                        },
                        type: 'POST',
                        cache: false,
                        success: function(frm) {
                            if (frm == "no") {
                                // $("#first_name").prop("disabled", false);
                                // $("#record_date").prop("disabled", false);
                                // $("#image").prop("disabled", false);
                                // $("#age").prop("disabled", false);
                                // $("#gender").prop("disabled", false);
                                var first_name = $("#first_name").val();
                                if (first_name === '') {
                                    $("#first_name").focus();
                                } else {
                                    $("#mobile").focus();
                                }
                            } else if (frm == "no1") {
                                $("#civil").focus();
                            } else {
                                $.notify("{{ __('app.id_number_already_exists') }}", 'success');
                                $("#editcompany").modal("show");
                                $("#box_edit").html(frm);
                                msg2 = 'yes';
                            }
                        },
                        error: function(xhr) {
                            alert('error');
                        }
                    });
                }

            };

            function search_patient_mobile() {
                var id = $("#mobile").val();
                var type = "mobile";

                $.ajax({
                    url: '../company_edit',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id,
                        type: type
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        if (frm == "no") {
                            // $("#first_name").prop("disabled", false);
                            // $("#record_date").prop("disabled", false);
                            // $("#image").prop("disabled", false);
                            // $("#age").prop("disabled", false);
                            // $("#gender").prop("disabled", false);
                            var first_name = $("#first_name").val();
                            if (first_name === '') {
                                $("#first_name").focus();
                            } else {
                                $("#mobile").focus();
                            }
                        } else if (frm == "no1") {
                            $("#civil").focus();
                        } else {
                            $.notify("{{ __('app.id_number_already_exists') }}", 'success');
                            $("#editcompany").modal("show");
                            $("#box_edit").html(frm);
                            msg2 = 'yes';

                        }
                    },
                    error: function(xhr) {
                        alert('error');
                    }
                });
            };

            $(document).ready(function() {
                $("#add_patient").on('submit', (function(e) {
                    var name = $('#first_name').val();
                    var civil = $('#civil').val();
                    var mobile = $('#mobile').val();
                    var national = $('#national').val();

                    if (mobile === '') {
                        search_patient();
                        e.preventDefault();
                    } else if (civil === '') {
                        alert(mobile);
                        e.preventDefault();
                    }
                     else {
                        e.preventDefault();
                        var fd = new FormData(this);
                        $.ajax({
                            url: '../savePatient',
                            data: fd,
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            contentType: false,
                            processData: false,
                            cache: false,
                            //dataType: 'json',
                            success: function(data) {
                                $.notify('{{ __('data_saved_successfully') }}', 'success');
                                // $("#editcompany").modal("show");
                                // $("#box_edit").html(data);
                                $('#add_patient')[0].reset();
                                // $("#first_name").prop("disabled", true);
                                // $("#record_date").prop("disabled", true);
                                // $("#image").prop("disabled", true);
                                // $("#age").prop("disabled", true);
                                // $("#gender").prop("disabled", true);
                                $("#civil").focus();
                            },
                            error: function(xhr) {
                                errors = xhr.responseJSON.errors;
                                for (error in errors) {
                                    $.notify(errors[error][0], 'error');
                                }
                            }
                        });
                    }

                }));
            })
        </script>
    @endpush
    <style media="screen">
        #homepagearea .tab-pane .block3 .title,
        #homepagearea .tab-pane .block2 .title {
            margin: 0px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

    </style>
    <div class="clearfix"></div>
    <div id="homepagearea">
        <div class="tab-content">
            <div class="tab-pane active" id="tabone">
                <form id="add_patient">
                    <div class="row" style="display: flex; width: 100%; margin: 0;">
                        <div class="col-xs-12 col-sm-12  col-lg-10 col-lg-offset-1" style="padding:10px">
                            <div class="block1">
                                <div class="title">{{ __('app.patient_personal_information') }}</div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <!-- <input type="text" id="civil" class="numbers" maxlength="10" value="{{ old('civil') }}" name="civil"
                        autofocus placeholder="{{ trans('admin.civil') }}" onchange="search_patient()"> -->
                                        <input type="text" id="civil" class="numbers" maxlength="10"
                                            value="{{ old('civil') }}" name="civil" autofocus
                                            placeholder="{{ __('app.id_number') }}" minlength="10"  required>


                                        <input type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name') }}"
                                            placeholder="{{ trans('admin.first_name') }}" required>
                                        <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}"
                                            placeholder="{{ trans('admin.mobile') }}" required>

                                        {!! Form::select('gender', ['male' => trans('admin.male'), 'female' => trans('admin.female')], old('gender'), ['placeholder' => trans('admin.gender'), 'class' => 'gender', 'id' => 'gender']) !!}
                                        <p>
                                            <select class="form-control" name="city">
                                                <option value="">{{ __('app.choose_city') }}</option>
                                                @foreach (\DB::table('citys')->get() as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">



                                        <input type="text" id="date_birh_hijri" name="date_birh_hijri" autocomplete="off"
                                            value="{{ old('date_birh_hijri') }}"
                                            placeholder="{{ trans('admin.date_birh_hijri') }}">
                                        <input type="number" id="age" name="age" class="age"
                                            value="{{ old('age') }}" placeholder="{{ trans('admin.age') }}">
                                        {!! Form::select('nationality', App\Models\Nationalities::pluck('nat_name', 'id'), old('nationality'), ['class' => 'form-control', 'placeholder' => trans('admin.nationality'), 'id' => 'national','required' => 'true']) !!}
                                        <input type="file" name="image" id="image" class="form-control">

                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </div><!-- end block1 -->
                            <script>
                                vpm1 = 0;
                                vpm2 = 0;
                                vpm3 = 0;
                                vpm4 = 0;

                                function isEven(n) {
                                    n = Number(n);
                                    return n === 0 || !!(n && !(n % 2));
                                }

                                $(document).ready(function() {

                                    $("#pm1").on("click", function() {
                                        $("#demo1").collapse('toggle');
                                        if (isEven(vpm1++)) {
                                            $("#pmv1").html('-');
                                        } else {
                                            $("#pmv1").html('+');
                                        }
                                    });

                                    $("#pm2").on("click", function() {
                                        $("#demo2").collapse('toggle');
                                        if (isEven(vpm2++)) {
                                            $("#pmv2").html('-');
                                        } else {
                                            $("#pmv2").html('+');
                                        }
                                    });

                                    $("#pm3").on("click", function() {
                                        $("#demo3").collapse('toggle');
                                        if (isEven(vpm3++)) {
                                            $("#pmv3").html('-');
                                        } else {
                                            $("#pmv3").html('+');
                                        }
                                    });
                                    $("#pm4").on("click", function() {
                                        $("#demo4").collapse('toggle');
                                        if (isEven(vpm4++)) {
                                            $("#pmv4").html('-');
                                        } else {
                                            $("#pmv4").html('+');
                                        }
                                    });
                                });
                            </script>
                            <div class="block3">
                                <div id="pm1" class="row title" style="margin: 0px;">
                                    <div class="col-md-11 text-center"> {{ __('app.patient_medical_information') }} </div>
                                    <div id="pmv1" class="col-md-1" style="text-align: right; font-size: 20px;">+
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div id="demo1" class="collapse">

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.sensitivity_penicillin') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="sensitivity_penicillin"
                                                                    {{ old('sensitivity_penicillin') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="sensitivity_penicillin1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="sensitivity_penicillin"
                                                                    {{ old('sensitivity_penicillin') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="sensitivity_penicillin2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.teeth_medicine') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="teeth_medicine"
                                                                    {{ old('teeth_medicine') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="teeth_medicine1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="teeth_medicine"
                                                                    {{ old('teeth_medicine') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="teeth_medicine2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.taking_drugs') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="taking_drugs"
                                                                    {{ old('taking_drugs') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="taking_drugs1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="taking_drugs"
                                                                    {{ old('taking_drugs') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="taking_drugs2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->

                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->
                                        </div>

                                        <div class="form-group drugs_names hidden">
                                            <label for="drugs_names"
                                                class="col-xs-4 col-sm-4 col-md-4 col-lg-4">{{ trans('admin.drugs_names') }}</label>

                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <textarea name="drugs_names" id="drugs_names"
                                                    placeholder="{{ trans('admin.drugs_names') }}">{{ old('drugs_names') }}</textarea>
                                            </div><!-- end col-lg-3 -->

                                            <div class="clearfix"></div>
                                        </div><!-- end form-group -->

                                    </div><!-- end row -->
                                </div><!-- end content -->
                            </div><!-- end block2 -->
                            <div class="block2">
                                <div id="pm2" class="row title" style="margin: 0px;">
                                    <div class="col-md-11 text-center">{{ trans('admin.comments') }}</div>
                                    <div id="pmv2" class="col-md-1" style="text-align: right; font-size: 20px;">+
                                    </div>
                                </div>
                                <div id="demo2" class="collapse">
                                    <div class="content">
                                        <textarea class="addnote" name="comments" placeholder="{{ trans('admin.comments') }}" id="" cols="30"
                                            rows="10">{{ old('comments') }}</textarea>
                                    </div><!-- end content -->
                                </div><!-- end block2 -->
                            </div>
                            <div class="block3">
                                <div id="pm3" class="row title" style="margin: 0px;">
                                    <div class="col-md-11 text-center">{{ trans('admin.purpose_visit') }}</div>
                                    <div id="pmv3" class="col-md-1" style="text-align: right; font-size: 20px;">+
                                    </div>
                                </div>
                                <div id="demo3" class="collapse">
                                    <div class="content">
                                        <div class="row">

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-5 col-lg-5">{{ trans('admin.purpose_visit') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <textarea name="purpose_visit" id="purpose_visit" cols="30" rows="10"
                                                        placeholder="{{ trans('admin.purpose_visit') }}">{{ old('purpose_visit') }}</textarea>
                                                </div><!-- end col-lg-12 -->

                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->
                                        </div><!-- end row -->
                                    </div><!-- end content -->
                                </div><!-- end content -->
                            </div><!-- end block3 -->
                            <div class="block3">
                                <div id="pm4" class="row title" style="margin: 0px;">
                                    <div class="col-md-11 text-center">{{ trans('admin.group_questions') }}</div>
                                    <div id="pmv4" class="col-md-1" style="text-align: right; font-size: 20px;">+
                                    </div>
                                </div>
                                <div id="demo4" class="collapse">
                                    <div class="content">
                                        <div class="row">

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.heart_disease') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="heart_disease"
                                                                    {{ old('heart_disease') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="heart_disease1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="heart_disease"
                                                                    {{ old('heart_disease') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="heart_disease2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.high_low_blood') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="high_low_blood"
                                                                    {{ old('high_low_blood') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="high_low_blood1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="high_low_blood"
                                                                    {{ old('high_low_blood') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="high_low_blood2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.rheumatic_fever') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rheumatic_fever"
                                                                    {{ old('rheumatic_fever') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="rheumatic_fever1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rheumatic_fever"
                                                                    {{ old('rheumatic_fever') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="rheumatic_fever2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.anemia') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="anemia"
                                                                    {{ old('anemia') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="anemia1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="anemia"
                                                                    {{ old('anemia') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="anemia2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.thyroid_disease') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="thyroid_disease"
                                                                    {{ old('thyroid_disease') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="thyroid_disease1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="thyroid_disease"
                                                                    {{ old('thyroid_disease') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="thyroid_disease2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.hepatitis') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hepatitis"
                                                                    {{ old('hepatitis') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="hepatitis1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hepatitis"
                                                                    {{ old('hepatitis') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="hepatitis2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.diabetes') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes"
                                                                    {{ old('diabetes') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="diabetes1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes"
                                                                    {{ old('diabetes') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="diabetes2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->


                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.asthma') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asthma"
                                                                    {{ old('asthma') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="asthma1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asthma"
                                                                    {{ old('asthma') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="asthma2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->


                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.kidney_disease') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="kidney_disease"
                                                                    {{ old('kidney_disease') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="kidney_disease1" value="yes">
                                                                {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="kidney_disease"
                                                                    {{ old('kidney_disease') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="kidney_disease2"
                                                                    value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->


                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.tics') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tics"
                                                                    {{ old('tics') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="tics1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tics"
                                                                    {{ old('tics') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="tics2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->

                                            <div class="form-group pregnant hidden">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.pregnant') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="radioarea">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="pregnant"
                                                                    {{ old('pregnant') == 'yes' ? 'checked="checked"' : '' }}
                                                                    id="pregnant1" value="yes"> {{ trans('admin.yes') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="pregnant"
                                                                    {{ old('pregnant') == 'no' ? 'checked="checked"' : '' }}
                                                                    id="pregnant2" value="no">{{ trans('admin.no') }}
                                                            </label>
                                                        </div><!-- end radioarea -->
                                                    </div><!-- end col-lg-3 -->
                                                </div><!-- end col-lg-8 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->




                                            <div class="form-group">
                                                <label for="#"
                                                    class="col-xs-12 col-sm-12 col-md-3 col-lg-3">{{ trans('admin.other_diseases') }}</label>
                                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                                    <textarea name="other_diseases" id="other_diseases" cols="4" rows="2"
                                                        placeholder="{{ trans('admin.other_diseases') }}">{{ old('other_diseases') }}</textarea>
                                                </div><!-- end col-lg-7 -->
                                                <div class="clearfix"></div>
                                            </div><!-- end form-group -->
                                        </div><!-- end row -->
                                    </div><!-- end content -->
                                </div><!-- end block3 -->
                                <div><br>
                                    <center><button style="dth: 130px;
        padding: 7px;" type="submit">{{ __('app.save_date') }}</button></center>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- end col-lg-8 -->
                        </div><!-- end row -->
                </form>
            </div><!-- end tabone -->
            <div class="tab-pane" id="tabtwo">

            </div><!-- end tabtwo -->
        </div><!-- end tab-content -->
    </div><!-- end tab-content -->


    </div>

    <div class="clearfix"></div>
    {!! modelBox('editcompany', __('app.id_number_already_exists'), 'box_edit', 'status_update', 'update_company') !!}
@stop
