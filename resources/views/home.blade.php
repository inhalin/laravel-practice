<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>첫 화면</title>
</head>
<body>
    <p>안녕하세요
    @if (Auth::check())
        {{ Auth::user()->name }}님!</p>
        <p><a href="/logout">로그아웃</a></p>
    @else
        !</p>
        <p>
            <a href="/login">로그인</a>
            <a href="/register">회원등록</a>
        </p>
    @endif
</body>
</html>
