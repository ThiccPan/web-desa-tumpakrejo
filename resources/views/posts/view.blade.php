<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $postsView->title }}</title>
  <a href="/posts">kembali</a>
</head>
<body>
  <h1>{{ $postsView->title }}</h1>
  <h2>{{ $postsView->category }}</h2>
  <h2>{{ $postsView->author }}</h2>
  <p>{{ $postsView->description }}</p>
</body>
</html>