@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="float-left">Articles</h4>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary float-right">
              Add New Article
            </a>
            <div class="clearfix"></div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <th>#</th>
                  <th>Title</th>
                  <th>Tags</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($articles as $article)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $article->title }}</td>
                      <td>
                        @foreach ($article->tags as $tag)
                          <span class="badge badge-primary">{{ $tag->name }}</span>
                        @endforeach
                      </td>
                      <td>{{ $article->created_at->diffForHumans() }}</td>
                      <td>
                        <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-primary btn-sm">
                          View
                        </a>
                        <a href="{{ route('admin.articles.destroy', $article->id) }}" class="btn btn-danger btn-sm">
                          Delete
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
