@extends('doctor.layout.index')
@section('content')
<style media="screen">
.table.table-bordered thead>tr>th {
    text-align: center;
  }

</style>
    <div class="">
        <h4>{{__("app.Previous_dates")}}</h4>
        <div class=" m-3" style="margin-bottom:10px;padding:10px">
            <div class="col-12">
                <form>
                    <div class="row p-2">
                        <input style="margin:5px" class="" name="in_day" type="date" value="{{old('in_day',request()->in_day)}}">
                        <button style="margin:5px" type="submit" class="btn btn-sm btn-success">{{__("app.search")}}</button>
                        <a style="margin:5px" href="{{route('doctor.last,appointments')}}" class="btn btn-sm btn-primary">{{__("app.appointments")}}</a>
                        <a style="margin:5px" href="{{route('doctor.last,appointments')}}?in_day={{\Carbon\Carbon::today()->toDateString()}}" class="btn btn-sm btn-info">{{__("app.Todays_appointments")}}</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="" style="overflow:auto">
          <table class=" table table-bordered text-center" style="min-width:1000px">
              <thead style="background-color: #16124c; color: #fff;">
                  <th>#</th>
                  <th>بتاريخ</th>
                  <th>وقت</th>
                  <th>المريض</th>
                  <th>حالة الموعد</th>
                  <!-- <th width="35%">اخر تشخيص للمريض</th> -->
              </thead>
              <tbody>
                  @forelse($items as $item)
                      <tr>
                          <td>{{$item->id}}</td>
                          <td>{{$item->in_day}}</td>
                          <td>{{$item->in_time}}</td>
                          <td>{{$item->patient->first_name}}</td>
                          <td>{{get_status($item->appoint_status)}}</td>
                          <!-- <td>{{$item->patient->diagnos->last()->treatment ?? "لم يحدد"}}</td> -->
                      </tr>
                  @empty
                      <tr>
                          <td colspan="1000">لا يوجد</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>

        </div>

        {{$items->links()}}
    </div>
@endsection
