<!DOCTYPE html>
<html>
<head>
    <title>Favorite Movies List</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
            margin:0;
        }

        header{
            background:#222;
            color:white;
            padding:20px;
            text-align:center;
        }

        footer{
            background:#222;
            color:white;
            text-align:center;
            padding:10px;
            margin-top:30px;
        }

        .container{
            width:80%;
            margin:auto;
            padding:20px;
        }

        .card{
            background:white;
            padding:15px;
            margin-bottom:15px;
            border-radius:8px;
        }

        a{
            text-decoration:none;
            color:blue;
        }

        .btn{
            background:#333;
            color:white;
            padding:10px 15px;
            border-radius:5px;
        }
    </style>

</head>
<body>

<header>
    <h1>Favorite Movies List System</h1>
</header>

<div class="container">
    @yield('content')
</div>

<footer>
    <p>Laravel Mini System Activity</p>
</footer>

</body>
</html>