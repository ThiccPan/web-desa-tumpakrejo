<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="/posts/create">Add new Post</a>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Category</th>
      <th>Author</th>
      <th>Action</th>
    </tr>
    @foreach ($posts as $post)
      <tr>
        <td>{{ $post['id'] }}</td>
        <td>{{ $post['title'] }}</td>
        <td>{{ $post['category'] }}</td>
        <td>{{ $post['author'] }}</td>
        <td><a href="/posts/{{ $post->id }}">view</a> 
          <br/>
          <a href="/posts/{{ $post->id }}/edit">edit</a> 
          <form action="/posts/{{ $post->id }}/destroy" method="post">
            @csrf
            @method('delete')
            <input type="submit" name="submit" value="delete">
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</body>
</html>