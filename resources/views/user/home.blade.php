<html >
<head>
    <title>User Home Page</title>
</head>
<body>
       <h1>User Home Page</h1>

       Role - {{ Auth::user()->role }}

        <form action="{{ route('logout') }}" method="post">
         @csrf
            <input type="submit" value="Logout">
        </form>
</body>
</html>
