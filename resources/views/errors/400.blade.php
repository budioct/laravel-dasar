<html>
<head>
    <title>400 - Bad Request</title>
</head>
<body>
<!--
$exception adalah variable global exception
getMessage() get pesan error dari exception
-->
<h1>Bad Request: {{ $exception->getMessage() }}</h1>
</body>
</html>
