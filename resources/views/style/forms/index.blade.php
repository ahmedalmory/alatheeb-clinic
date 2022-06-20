@extends('style.index')

@section('content')
    <div class="container">
        <div class="row">
            @foreach(\App\Model\Forms::all() as $form)
                <div class="col-md-3">
                    <h4>{{$form->form_name}}</h4>
                    <a href="#">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@stop
