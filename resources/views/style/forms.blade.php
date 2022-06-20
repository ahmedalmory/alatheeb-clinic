@extends('style.index')
@section('content')
 <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
          <div class="medicalforms">
            <div class="title">نماذج طبية</div>
            <div class="content">
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>م</th>
                      <th>الاسم</th>
                      <th>المعاينة</th>
                    </tr>
                  </thead>
                    @foreach($forms as $file)
                      <tr>
                        <td>{{ $file->id }}</td>
                        <td style="text-align: right;">{{ $file->form_name }}</td>
                        <td>
                          <a href="{{ it()->url($file->form) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                          <!-- <a href="#" title="'طباعة'" class="btn btn-success"><i class="fa fa-print"></i></a> -->
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div><!-- end table-responsive -->
               {!! $forms->render() !!}
            </div><!-- end content -->
          </div><!-- end medicalforms -->
        </div><!-- end col-lg-8 -->
      </div><!-- end row -->



@endsection
