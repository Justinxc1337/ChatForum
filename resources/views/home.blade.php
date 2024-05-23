<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Home</title>
</head>
<body>

    @auth
    <header>
        <nav class="container">
            <div class="logo">
                <img src="image/logoResized.png" alt="Logo">
                <span id="headertext">ChatForum</span>
            </div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="mainforum">Forum</a></li>
                <li><a href="profile">My Profile</a></li>
                <li>
                    <a href="/logout" onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')){document.getElementById('logout-form').submit();}" class="logoutbutton">Logout</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <article class="post-section">
            <section class="newpost post-container">
                <p>Create a new post</p>
                <form action="/create-post" method="POST">
                    @csrf
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" placeholder="Title">
                    <label for="body">Content</label>
                    <textarea id="body" name="body" placeholder="Content"></textarea>
                    <button class="button">Create Post</button>
                </form>
            </section>

            <section class="all-posts">
                <h2>All My Posts</h2>
                @foreach ($posts as $post)
                <div class="post-item">
                    <h3><a href="/post/{{ $post->id }}">{{ $post->title }}</a> by {{$post->user->name}}</h3>
                    <!-- <h3>{{ $post->title }} by {{$post->user->name}}</h3> -->
                    <p>{{ $post->body }}</p>
                    <p><a href="/edit-post/{{$post->id}}">Edit Post</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete Post</button>
                    </form>
                </div>
                @endforeach
            </section>
        </article>
    </main>

    @else
    <header>
        <nav class="container">
            <div class="logo">
                <img src="image/logoResized.png" alt="Logo">
                <span id="headertext">ChatForum</span>
            </div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="mainforum">Forum</a></li>
                <li><a href="profile">My Profile</a></li>
                <li>
                    <a href="/logout" onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')){document.getElementById('logout-form').submit();}" class="logoutbutton">Logout</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="Username">
                <input name="loginpassword" type="password" placeholder="Password">
                <button>Login</button>
            </form>
        </div>
        <div class="auth-box">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Username">
                <input name="email" type="text" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
                <button>Register</button>
            </form>
        </div>
    </div>
    @endauth

</body>
</html>
