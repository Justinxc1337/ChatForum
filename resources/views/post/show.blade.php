<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/postshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <title>{{$post->user->name}}'s Post / {{$post->title}}</title>
</head>
<body>

    <header>
        <nav class="container">
            <div class="logo">
                <img src="../image/logoResized.png" alt="Logo">
                <span id="headertext">ChatForum</span>
            </div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="../mainforum">Forum</a></li>
                <li><a href="../profile">My Profile</a></li>
                <li>
                    @auth
                        <a href="/logout" onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')){document.getElementById('logout-form').submit();}" class="logoutbutton">Logout</a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <article>
            <section class="post">
                <p class="text">Post created on {{$post->created_at}} by {{$post->user->name}}</p>
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->body }}</p>
            </section>


            <section class="comments-section">
                <p class="text">Add a comment</p>
                <form action="/post/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="body" placeholder="Your comment"></textarea>
                    <button type="submit">Add Comment</button>
                </form>

                @foreach ($post->comments as $index => $comment)
                <section class="{{ $index % 2 == 0 ? 'comment-white' : 'comment-gray' }}">
                    <p>{{ $comment->body }}</p>
                    <p class="commentpost">Posted by: {{ $comment->user->name }} on {{ $comment->created_at }}</p>
                </section>
                @endforeach
            </section>
        </article>
    </main>

</body>
</html>