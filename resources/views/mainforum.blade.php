<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/mainforum.css') }}">
    <title>Forum | All Posts</title>
</head>
<body>
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
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="Search posts / dont work yet">
            <button type="submit">Search</button>
        </form>

        <article>
            <h2 id="allpost">All Posts - There are {{count($posts)}} in total</h2>
            @foreach ($posts as $post)
            <section class="posts">
                <h3><a href="/post/{{ $post->id }}" class="postitle">{{ $post->title }}</a> by {{$post->user->name}}</h3>
                <!-- <h3 style="text-decoration: underline">{{ $post->title }} by {{$post->user->name}}</h3> -->
                <p>{{ $post->body }}</p>
            </section>
        </article>
        @endforeach

    </main>
</body>
</html>