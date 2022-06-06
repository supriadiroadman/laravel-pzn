<html>
<head>
    <title>Document</title>
</head>
<body>
<form action="/form" method="post">
{{--    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    @csrf
    <label for="name"> Name:
        <input type="text" name="name">
    </label>
    <button type="submit">Send</button>
</form>
</body>
</html>
