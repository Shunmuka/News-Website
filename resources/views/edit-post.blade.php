<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Edit Post</h1>
  <form action="/edit-post/{{$article->id}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{$article->title}}">
    <textarea name="body">{{$article->body}}</textarea>
    <button>Save Changes</button>
  </form>
</body>
</html>