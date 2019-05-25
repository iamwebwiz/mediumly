@extends('layouts.app')

@section('extra_styles')
  <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css">
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4>Add Article</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Article title">
              </div>
              <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" multiple id="tags" class="custom-select select2">
                  @foreach ($tags as $tag)
                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="">Featured Image</label>
                <div class="custom-file">
                  <label for="featuredImage" class="custom-file-label">Choose Image</label>
                  <input type="file" name="featured_image" id="featuredImage" accept="image/*" class="custom-file-input">
                </div>
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="6" class="form-control summernote"></textarea>
              </div>

              <button class="btn btn-primary btn-lg">Publish</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

  <script>
    $(".select2").select2({
      tags: true,
      placeholder: 'Choose tags',
      allowClear: true
    });

    $('.summernote').summernote({
      placeholder: 'Craft your article content...',
      height: 200
    });
  </script>
@endsection
