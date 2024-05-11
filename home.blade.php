<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
    
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    <div style="border: 3px solid black">
        <h2>Create a new post</h2>

        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="post title">
            <textarea name="body" placeholder="body content..."></textarea>
            <button>Save Post</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>Your Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    <div style="border: 3px solid black">
        <h2>Feed</h2>
        @foreach($allPosts as $allPost)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            @if($loop->index < 4)
                <!-- This is a comment-->
                <!-- Also, only the first 3 user posts will be displayed -->
                <h3>{{$allPost['title']}} by {{$allPost->user->name}}</h3>
                
                {{$allPost['body']}}
            @endif

        </div>
        @endforeach
    </div>

    @else

    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>What others like you are posting!</h2>

        @foreach($allPosts as $allPost)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            @if($loop->index > 3)
            <!-- This is a comment-->
                <h3>Register to see more posts!</h3>
            @endif

            <h3>{{$allPost['title']}} by {{$allPost->user->name}}</h3>
            
            {{$allPost['body']}}

        </div>
        @endforeach
    </div>

    @endauth
    

    
</body>
</html>