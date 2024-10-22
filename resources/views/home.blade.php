<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>

<body>
    @auth
    <p> Auth success</p>
    <form action="/logout" method="post">
        @csrf
        <input type="submit" value="logout">
    </form>
    <form action="/create-post" method="post">
        @csrf
        <input type="text" name="title" placeholder="title">
        <textarea name="body" id="" placeholder="body"></textarea>
        <input type="submit" value="post">
    </form>

    <h2> all posts </h2>
    @foreach($posts as $post)
    <div class="flex">
        <h3>{{$post['title']}} by {{$post->user->name}}</h3>
        <p>{{$post['body']}}</p>
        <a href="/edit-post/{{$post->id}}"> edit post</a>
        <form action="/delete-post/{{$post->id}}" method="POST"> ]
            @csrf
            @method('DELETE')
            <input type="submit" value="deletepost">
        </form>

    </div>
    @endforeach
    @else
    <form action="register" method="POST">
        @csrf

        <input type="text" placeholder="Name" name="name">
        <input type="email" placeholder="email" name="email">

        <input type="password" placeholder="password" name="password">
        <input type="submit" value="submit">

    </form>
    <form action="login" method="POST">
        @csrf

        <input type="text" placeholder="Name" name="loginname">


        <input type="password" placeholder="password" name="loginpassword">
        <input type="submit" value="submit">

    </form>
    @endauth


</body>

</html>