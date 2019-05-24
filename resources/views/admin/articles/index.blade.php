@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4>Articles</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <th>#</th>
                  <th>Title</th>
                  <th>Created At</th>
                </thead>
                <tbody>
                  @foreach ($articles as $article)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $article->title }}</td>
                      <td>{{ $article->created_at->diffForHumans() }}</td>
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
