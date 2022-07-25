<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    form {
      display:block;
      
    }
  </style>
  <title>Document</title>
</head>
<body>
  <form action="/posts/insert" method="post" enctype="multipart/form-data">
    @csrf
    title: <input type="text" name="title" id=""><br>
    description: <input type="textarea" name="description" id=""><br>
    category: <input type="text" name="category" id=""><br>
    author: <input type="text" name="author" id=""><br>
    <input type="submit" value="submit" name="submit">
  </form>
  <a href="/posts">kembali</a>
</body>
</html>