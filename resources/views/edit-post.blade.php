<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit post </title>
</head>

<body>
    <form action="/edit-post/{{$post->id}}" method="post">

        @csrf

        @method('PUT')
        <input type="text" name="title" placeholder="title" value="{{$post->title}}">
        <textarea name="body" placeholder="body">{{$post->body}}
        </textarea>
        <input type="submit" value="save">
    </form>

</body>

</html>