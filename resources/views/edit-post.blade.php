<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/editpost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <title>Edit Post{{'user_id'}}</title>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">
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

    <main class="content-container">
        <article class="postcontainer">
        <p>Edit Post</p>
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">Title</label>
            <input name="title" type="text" placeholder="{{$post->title}}" value="{{$post->title}}">
            <label for="body">Content</label>
            <textarea name="body" placeholder="{{$post->body}}">{{$post->body}}</textarea>
            <button>Save Changes</button>
        </form>
        </article>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div>
                    <a href="/about">About Us</a>
                    <a href="/contact">Contact</a>
                    <a href="/privacy">Privacy Policy</a>
                </div>
                <div>
                    CVR: 12345678 | Phone: +45 10 20 30 40
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>