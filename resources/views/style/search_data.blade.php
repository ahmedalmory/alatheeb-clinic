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


	{!! $patients->appends([
		'search_civil'=>request('search_civil'),
		'first_name'=>request('first_name'),
		'father_name'=>request('father_name'),
		'grand_name'=>request('grand_name'),
		'title'=>request('title'),
		'search_mobile'=>request('search_mobile'),
		'home_medicine'=>request('home_medicine'),
		'chronic_diseases'=>request('chronic_diseases'),
	])->render() !!}
	</div><!-- end homepagetable -->



@endsection
