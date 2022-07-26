@extends('style.index')
@section('content')
    @push('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.get_patient').select2({
                    ajax: {
                        url: '{{ url('get/patient') }}',
                        dataType: 'json',
                        delay: 250,
                        type: 'post',
                        data: function(params) {
                            return {
                                text: params.term, // search term
                                page: params.page,
                                _token: '{{ csrf_token() }}'
                            };
                        },
                        processResults: function(data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;
                            console.log(data);
                            return {
                                results: data.users,
                                pagination: {
                                    more: (params.page * 30) < data.count
                                }
                            };
                        },
                        placeholder: '{{ trans('admin.search') }}',
                        escapeMarkup: function(markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        cache: true
                    }
                });
                $(document).on('change', '.group_id', function() {
                    var group_id = $('.group_id option:selected').val();
                    if (group_id > 0) {
                        $.ajax({
                            url: '{{ url('load/users') }}',
                            type: 'post',
                            dataType: 'html',
                            data: {
                                group_id: group_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('.user_id').removeClass('hidden');
                                $('.user_id').html(data);
                            }
                        });
                    }
                });
                @if (old('user_id') and old('group_id'))
                    $.ajax({
                    url: '{{ url('load/users') }}',
                    type: 'post',
                    dataType: 'html',
                    data: {
                    group_id: '{{ old('group_id') }}',
                    _token: '{{ csrf_token() }}',
                    select: '{{ old('user_id') }}'
                    },
                    success: function (data) {
                    $('.user_id').removeClass('hidden');
                    $('.user_id').html(data);
                    }
                    });
                @endif

                $(document).on('change', '#patient_id,#dep_id,#user_id,.period,.in_day', function() {
                    var period = $('.period option:selected').val();
                    var patient_id = $('#patient_id option:selected').val();
                    var dep_id = $('#dep_id option:selected').val();
                    var user_id = $('#user_id option:selected').val();
                    var day = $('.in_day').val();
                    $.ajax({
                        url: '{{ url('load/period') }}',
                        dataType: 'html',
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            day: day,
                            period: period,
                            patient_id:patient_id,
                            dep_id:dep_id,
                            user_id:user_id,
                        },
                        beforeSend: function() {
                            $('.in_time_load').removeClass('hidden');
                            $('.in_time').html('');
                        },
                        success: function(data) {
                            $('.in_time_load').addClass('hidden');
                            $('.in_time').html(data);
                        }
                    });
                });

                @if (old('in_day') and old('period'))
                    $.ajax({
                    url: '{{ url('load/period') }}',
                    dataType: 'html',
                    type: 'post',
                    data: {
                    _token: '{{ csrf_token() }}',
                    day: '{{ old('in_day') }}',
                    period: '{{ old('period') }}',
                    select: '{{ old('in_time') }}'
                    },
                    beforeSend: function () {
                    $('.in_time_load').removeClass('hidden');
                    $('.in_time').html('');
                    },
                    success: function (data) {
                    $('.in_time_load').addClass('hidden');
                    $('.in_time').html(data);
                    }
                    });
                @endif
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('#jstree').jstree({
                    "core": {
                        'data': {!! load_dep(old('dep_id')) !!},
                        "themes": {
                            "variant": "large"
                        }
                    },
                    "checkbox": {
                        "keep_selected_style": false
                    },
                    "plugins": ["wholerow"]
                });

            });

            $('#jstree').on('changed.jstree', function(e, data) {
                var i, j, r = [];
                for (i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.dep_id').val(r.join(', '));
            });
        </script>
    @endpush
    <style media="screen">
        .md-radio label {
            padding: 0 26px !important;
        }

        .md-radio label>.box {
            top: 10px;
        }

        .select2-selection__rendered,
        .select2-container--default .select2-selection--single {
            direction: rtl;
            height: 40px;
            padding: 0 10px;
            font-size: 15px;
            color: #000;
        }

        .md-radio-list .md-radio {
            display: inline-block;
        }

    </style>
    <div class="row" id="new-appoint">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="datespage">
                <div class="title">{{ $title }}</div>
                <div class="content">
                    <div class="adddate">

                        {!! Form::open(['url' => url('/appointments'), 'id' => 'appointments', 'files' => true, 'class' => 'form-horizontal form-row-seperated']) !!}
                        <div class="clearfix"></div>
                        <div class="form-group">
                            {!! Form::label('patient_id', trans('admin.patient_id'), ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <input class="form-control" v-model="patient_search" name="patient_search" value="{{old('patient_search')}}">
                                <small style="color:#c33"><i class="fa fa-info"></i>
                                    {{ trans('admin.search_patient_at') }}</small>
                                <select name="patient_id" class="form-control" id="patient_id" v-if="patients_list.length">
                                    <option v-for="patient in patients_list" :value="patient.id">
                                        @{{ patient.first_name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('dep_id', 'العيادة', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <select name="dep_id" id="dep_id" class="form-control" v-model="dep_id">
                                    <option :value="null">احتر العيادة</option>
                                    @foreach (\App\Models\Department::all() as $dep)
                                        <option value="{{ $dep->id }}">{{ $dep->dep_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" v-if="dep_id">
                            {!! Form::label('user_id', 'الطبيب', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach (\App\Models\User::query()->where('group_id', 1)->get()
        as $doc)
                                        <option v-if="dep_id == '{{ $doc->dep_id }}'" value="{{ $doc->id }}" @if (old('user_id') && old('user_id')==$doc->id)
                                        selected
                                            @endif>
                                            {{ $doc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('period', trans('admin.period'), ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('period', ['morning' => trans('admin.morning'), 'evening' => trans('admin.evening')], old('period'), ['class' => 'form-control period', 'placeholder' => '...........']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('in_day', trans('admin.in_day'), ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::date('in_day', old('in_day') ? old('in_day') : date('Y-m-d'), ['class' => 'form-control in_day date-picker', 'placeholder' => trans('admin.in_day'), 'data-date' => date('Y-m-d'), 'data-date-format' => 'yyyy-mm-dd']) !!}
                            </div>
                        </div>

                        <i class="fa fa-spinner fa-spin in_time_load hidden"></i>
                        <div class="in_time">
                        </div>

                        <div class="form-group">
                            {!! Form::label('appoint_status', trans('admin.appoint_status'), ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('appoint_status', attend_status_list(), old('appoint_status'), ['class' => 'form-control', 'placeholder' => trans('admin.appoint_status')]) !!}
                            </div>
                        </div>

                        {!! Form::submit(trans('admin.add'), ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div><!-- end adddate -->
            </div><!-- end content -->
        </div><!-- end datespage -->
    </div><!-- end col-lg-2 -->
    </div><!-- end row -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <script>
        var app = new Vue({
            el: "#new-appoint",
            data: {
                patient_search: "{{old('patient_search')}}",
                patients_list:"{{old('patient_id')}}",
                dep_id: "{{old('dep_id')}}",
            },
            methods: {
                searchAboutPatient() {
                    if (this.patient_search.length)
                        axios.get('{{ url('api/patients') }}?search=' + this.patient_search).then(res => {
                            this.patients_list = res.data;
                        });
                    else{

                        this.patients_list = [];
                    }
                }
            },
            watch: {
                patient_search: 'searchAboutPatient',
            },
            mounted() {
                if(this.patient_search!=""){
                    axios.get('{{ url('api/patients') }}?search=' + this.patient_search).then(res => {
                            this.patients_list = res.data;
                        });

                }else{
                        this.patients_list = [];
                    }
            }
        });
    </script>

@stop
