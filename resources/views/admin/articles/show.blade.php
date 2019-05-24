@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ $article->title }}</h4>
          </div>
          <div class="card-body">
            {!! $article->content !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
