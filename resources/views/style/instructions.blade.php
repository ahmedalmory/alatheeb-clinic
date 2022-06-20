@extends('style.index')
@section('content')
   <div class="instructionspage">
      <div class="title">{{ $page->page_title }}</div>
      <div class="content">
      	{!! $page->page_content !!}
      </div>
    </div><!-- end instructionspage -->
@endsection
