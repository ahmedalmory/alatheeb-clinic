@extends('style.index')

@section('content')
    <title>{{$page->page_title}}</title>
    {!! $page->page_content !!}
@stop
