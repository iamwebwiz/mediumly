@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="float-left">{{ $article->title }}</h4>
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary float-right">
              Edit
            </a>
            <div class="clearfix"></div>
          </div>
          <div class="card-body">
            {!! $article->content !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
