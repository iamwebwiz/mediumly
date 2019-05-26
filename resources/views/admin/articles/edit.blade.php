@extends('layouts.app')

@section('extra_styles')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css">
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Article</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.articles.update', $article) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $article->title }}" class="form-control" id="title">
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="6" class="form-control summernote">{!! $article->content !!}</textarea>
              </div>

              <button class="btn btn-primary btn-lg">
                Update
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
  <script>
    $('.summernote').summernote({
      placeholder: 'Craft your article content...',
      height: 200
    });
  </script>
@endsection
