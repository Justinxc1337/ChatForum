<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>My Profile</title>
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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-container">
            <div class="profile-box">
                <p class="profiletext">My Profile</p>
                <p class="profileinfo">Name: {{ Auth::user()->name }}</p>
                <p class="profileinfo">Email: {{ Auth::user()->email }}</p>
            </div>

            <div class="profile-box">
                <p class="profiletext">Change Information</p>
                <form action="/reset-info" method="POST">
                    @csrf
                    <input name="newName" type="text" placeholder="New Username" value="{{ old('newName') }}">
                    <input name="newEmail" type="text" placeholder="New Email" value="{{ old('newEmail') }}">
                    <input name="newPassword" type="password" placeholder="New Password">
                    <input name="newPassword_confirmation" type="password" placeholder="Confirm New Password">
                    <button>Change</button>
                </form>
            </div>
        </div>

        <article class="post-section">
            <section class="all-posts">
                <h2>All My Posts</h2>
                @foreach ($posts as $post)
                <div class="post-item">
                    <h3>{{ $post->title }} by {{$post->user->name}}</h3>
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
