<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS"/>
    <title>ﾏｰﾁｬﾝﾄ購入ｷｬﾝｾﾙ</title>
</head>
<body>
Submit event listener
<table border='1'>
</table>

<form method="post" action="{{ route('event-listener-action') }}">
    {{ csrf_field() }}
    <input type="submit" value="submit">
</form>
</body>
</html>
