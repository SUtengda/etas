<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ETAS 税代</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- import CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style type="text/css">
        #login{
            width: 50%;
            height: 50%;
            text-align: center;
            position: absolute;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;

            margin: auto;
        }
    </style>
   </head>
<body>
<div id="login">
    <h3 align="center">欢迎登陆</h3><br />
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="form-group mt-3">
            <input type="email" name="email" class="form-control" placeholder="请属于邮箱"/>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="请输入密码"/>
        </div>
        <div class="form-group">
            <input type="submit" name="login" class="btn btn-primary w-100" value="登陆" />
        </div>
    </form>
</div>


</body>
</html>
