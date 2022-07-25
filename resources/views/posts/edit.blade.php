<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Post</title>
</head>
<body>
  <form action="/posts/{{ $postsEdit->id }}/update" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    title: <input type="text" name="title" id="" value="{{ $postsEdit->title }}"><br>
    
    category: <input type="text" name="category" id="" value="{{ $postsEdit->category }}"><br>
    
    author: <input type="text" name="author" id="" value="{{ $postsEdit->author }}" ><br>
    
    description: <input type="textarea" name="description" id="" value="{{ $postsEdit->description }}" rows="4" cols="50"><br>

    <input type="submit" value="submit" name="submit">
  </form>
</body>
</html>