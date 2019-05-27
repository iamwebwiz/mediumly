<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
</head>
<body>
  <div id="app">
    @auth
      <div class="bg-gray-200 py-5 px-5">
        <a href="{{ route('admin.dashboard') }}" class="text-indigo-700 font-bold">
          Admin
        </a>
      </div>
    @endauth
    <router-view></router-view>
  </div>

  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
