@extends('style.index')
@section('content')
 @push('js')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.gender',function(){
        var gender = $('.gender option:selected').val();
        if(gender  ==  'female')
        {
            $('.pregnant').removeClass('hidden');
        }else{
            $('.pregnant').addClass('hidden');
        }
    });


 @if($patients->gender  ==  'female')
        $('.pregnant').removeClass('hidden');
 @endif


    $(document).on('change','#taking_drugs',function(){
        var taking_drugs = $("#patients input[type='radio'][name='taking_drugs']:checked").val();

        if(taking_drugs  ==  'yes')
        {
            $('.drugs_names').removeClass('hidden');
        }else{
            $('.drugs_names').addClass('hidden');
        }
    });

 @if($patients->taking_drugs  ==  'yes')
        $('.drugs_names').removeClass('hidden');
 @endif
});

</script>
@endpush


<div class="clearfix"></div>
   <div id="homepagearea">
      <div class="tab-content">
        <div class="tab-pane active" id="tabone">
  {!! Form::open(['url'=>url('/patients/'.$patients->id),'method'=>'put','id'=>'patients','files'=>true,'class'=>'form-row-seperated']) !!}
     <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-lg-offset-1">
                <div class="block1">
                  <div class="title">المعلومات الشخصية عن المريض</div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                      <input type="text" id="first_name" name="first_name" value="{{ $patients->first_name }}" placeholder="{{ trans('admin.first_name') }}">
                     <input type="hidden" id="father_name" name="father_name" value="{{ $patients->father_name }}" placeholder="{{ trans('admin.father_name') }}">
                     <input type="hidden" id="grand_name" name="grand_name" value="{{ $patients->grand_name }}" placeholder="{{ trans('admin.grand_name') }}">
                      <input type="hidden" id="title" name="title" value="{{ $patients->title }}" placeholder="{{ trans('admin.title') }}">
                      {!! Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female'),],$patients->gender,['placeholder'=>trans('admin.gender'),'class'=>'gender']) !!}
                      <input type="hidden" id="mobile_nearby" name="mobile_nearby" value="{{ $patients->mobile_nearby }}" placeholder="{{ trans('admin.mobile_nearby') }}">
                       {!! Form::select('nationality',App\Model\Nationalities::pluck('nat_name','id'),$patients->nationality,['class'=>'form-control','placeholder'=>trans('admin.nationality')]) !!}
                    </div><!-- end col-lg-6 -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <input type="text" id="civil" value="{{ $patients->civil }}" name="civil" placeholder="{{ trans('admin.civil') }}">
                      <input type="hidden" id="f_number" value="{{ $patients->f_number }}" name="f_number" placeholder="{{ trans('admin.f_number') }}">
                      <input type="text" id="record_date"  value="{{ $patients->record_date?$patients->record_date:date('Y-m-d') }}" name="record_date" readonly data-date-format="yyyy-mm-dd" data-date="{{ date("Y-m-d") }}" class="date-picker"
                         placeholder="{{ trans('admin.record_date') }}">
                      <input type="text" id="age" name="age" class="age" value="{{ $patients->age }}" readonly placeholder="{{ trans('admin.age') }}">

                    <input type="text" id="date_birh_hijri" name="date_birh_hijri" readonly class="hijri" value="{{ $patients->date_birh_hijri }}"
                        placeholder="{{ trans('admin.date_birh_hijri') }}">
                      <input type="text" id="mobile" name="mobile" value="{{ $patients->mobile }}" placeholder="{{ trans('admin.mobile') }}">
                      <input type="hidden" name="phone" value="{{ $patients->phone }}" id="phone" placeholder="{{ trans('admin.phone') }}">
                    </div><!-- end col-lg-6 -->
                  </div><!-- end row -->
                </div><!-- end block1 -->
                <div class="block3">
                  <div class="title">معلومات طبيه عن المريض</div>
                  <div class="content">
                    <div class="row">


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.sensitivity_penicillin') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="sensitivity_penicillin"
                                      {{ $patients->sensitivity_penicillin == 'yes'?'checked="checked"':'' }}
                                      id="sensitivity_penicillin" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="sensitivity_penicillin"
                                      {{ $patients->sensitivity_penicillin == 'no'?'checked="checked"':'' }}
                                      id="sensitivity_penicillin" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.teeth_medicine') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="teeth_medicine"
                                      {{ $patients->teeth_medicine == 'yes'?'checked="checked"':'' }}
                                      id="teeth_medicine" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="teeth_medicine"
                                      {{ $patients->teeth_medicine == 'no'?'checked="checked"':'' }}
                                      id="teeth_medicine" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.taking_drugs') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="taking_drugs"
                                      {{ $patients->taking_drugs == 'yes'?'checked="checked"':'' }}
                                      id="taking_drugs" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="taking_drugs"
                                      {{ $patients->taking_drugs == 'no'?'checked="checked"':'' }}
                                      id="taking_drugs" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->

                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                      <div class="form-group drugs_names hidden">
                        <label for="drugs_names" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">{{ trans('admin.drugs_names') }}</label>

                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <textarea name="drugs_names"  id="drugs_names" placeholder="{{ trans('admin.drugs_names') }}" >{{ $patients->drugs_names }}</textarea>
                                </div><!-- end col-lg-3 -->

                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                    </div><!-- end row -->
                  </div><!-- end content -->
                </div><!-- end block2 -->
                <div class="block2">
                  <div class="title">{{ trans('admin.comments') }}</div>
                  <div class="content">
                    <textarea class="addnote" name="comments" placeholder="{{ trans('admin.comments') }}" id="" cols="30" rows="10">{{ $patients->comments }}</textarea>
                  </div><!-- end content -->
                </div><!-- end block2 -->
                <div class="block3">
                  <div class="title">{{ trans('admin.purpose_visit') }}</div>
                  <div class="content">
                    <div class="row">

                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">{{ trans('admin.purpose_visit') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <textarea name="purpose_visit" id="purpose_visit" cols="30" rows="10" placeholder="{{ trans('admin.purpose_visit') }}">{{ $patients->purpose_visit }}</textarea>
                        </div><!-- end col-lg-12 -->


                        <div class="clearfix"></div>
                      </div><!-- end form-group -->
                    </div><!-- end row -->
                  </div><!-- end content -->
                </div><!-- end block3 -->
                <div class="block3">
                  <div class="title">{{ trans('admin.group_questions') }} </div>
                  <div class="content">
                    <div class="row">


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.heart_disease') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="heart_disease"
                                      {{ $patients->heart_disease == 'yes'?'checked="checked"':'' }}
                                      id="heart_disease" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="heart_disease"
                                      {{ $patients->heart_disease == 'no'?'checked="checked"':'' }}
                                      id="heart_disease" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->




                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.high_low_blood') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="high_low_blood"
                                      {{ $patients->high_low_blood == 'yes'?'checked="checked"':'' }}
                                      id="high_low_blood" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="high_low_blood"
                                      {{ $patients->high_low_blood == 'no'?'checked="checked"':'' }}
                                      id="high_low_blood" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.rheumatic_fever') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="rheumatic_fever"
                                      {{ $patients->rheumatic_fever == 'yes'?'checked="checked"':'' }}
                                      id="rheumatic_fever" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="rheumatic_fever"
                                      {{ $patients->rheumatic_fever == 'no'?'checked="checked"':'' }}
                                      id="rheumatic_fever" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.anemia') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="anemia"
                                      {{ $patients->anemia == 'yes'?'checked="checked"':'' }}
                                      id="anemia" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="anemia"
                                      {{ $patients->anemia == 'no'?'checked="checked"':'' }}
                                      id="anemia" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->



                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.thyroid_disease') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="thyroid_disease"
                                      {{ $patients->thyroid_disease == 'yes'?'checked="checked"':'' }}
                                      id="thyroid_disease" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="thyroid_disease"
                                      {{ $patients->thyroid_disease == 'no'?'checked="checked"':'' }}
                                      id="thyroid_disease" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->

                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.hepatitis') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="hepatitis"
                                      {{ $patients->hepatitis == 'yes'?'checked="checked"':'' }}
                                      id="hepatitis" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="hepatitis"
                                      {{ $patients->hepatitis == 'no'?'checked="checked"':'' }}
                                      id="hepatitis" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->

                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.diabetes') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="diabetes"
                                      {{ $patients->diabetes == 'yes'?'checked="checked"':'' }}
                                      id="diabetes" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="diabetes"
                                      {{ $patients->diabetes == 'no'?'checked="checked"':'' }}
                                      id="diabetes" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.asthma') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="asthma"
                                      {{ $patients->asthma == 'yes'?'checked="checked"':'' }}
                                      id="asthma" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="asthma"
                                      {{ $patients->asthma == 'no'?'checked="checked"':'' }}
                                      id="asthma" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.kidney_disease') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="kidney_disease"
                                      {{ $patients->kidney_disease == 'yes'?'checked="checked"':'' }}
                                      id="kidney_disease" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="kidney_disease"
                                      {{ $patients->kidney_disease == 'no'?'checked="checked"':'' }}
                                      id="kidney_disease" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->


                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.tics') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="tics"
                                      {{ $patients->tics == 'yes'?'checked="checked"':'' }}
                                      id="tics" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="tics"
                                      {{ $patients->tics == 'no'?'checked="checked"':'' }}
                                      id="tics" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->

                      <div class="form-group pregnant hidden">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">{{ trans('admin.pregnant') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                  <div class="radioarea">
                                    <label class="radio-inline">
                                      <input type="radio" name="pregnant"
                                      {{ $patients->pregnant == 'yes'?'checked="checked"':'' }}
                                      id="pregnant" value="yes"> {{ trans('admin.yes') }}
                                    </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="pregnant"
                                      {{ $patients->pregnant == 'no'?'checked="checked"':'' }}
                                      id="pregnant" value="no">{{ trans('admin.no') }}
                                    </label>
                                  </div><!-- end radioarea -->
                                </div><!-- end col-lg-3 -->
                        </div><!-- end col-lg-8 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->




                      <div class="form-group">
                        <label for="#" class="col-xs-12 col-sm-12 col-md-3 col-lg-3">{{ trans('admin.other_diseases') }}</label>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                          <textarea name="other_diseases" id="other_diseases" cols="30" rows="10" placeholder="{{ trans('admin.other_diseases') }}">{{ $patients->other_diseases }}</textarea>
                        </div><!-- end col-lg-7 -->
                        <div class="clearfix"></div>
                      </div><!-- end form-group -->
                    </div><!-- end row -->
                  </div><!-- end content -->
                </div><!-- end block3 -->
                <div class="pull-left"><button type="submit" class="save"><i class="fa fa-plus"></i> {{ trans('admin.save') }}</button></div>
                <div class="clearfix"></div>
              </div><!-- end col-lg-8 -->
            </div><!-- end row -->
            {!! Form::close() !!}
       </div><!-- end tabone -->
        <div class="tab-pane" id="tabtwo">

        </div><!-- end tabtwo -->
      </div><!-- end tab-content -->


</div>

 <div class="clearfix"></div>
@stop
