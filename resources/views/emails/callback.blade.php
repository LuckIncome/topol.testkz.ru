<!DOCTYPE HTML>
<html>
<head>
    <title>Новая заявка с сайта</title>
</head>
<body>

<h1>Новая заявка с сайта</h1>
<br>
<p>Имя отправителя : {{$name}}</p>
<p>Телефон : {{$phone}}</p>
@isset($e_mail)
    <p>Email : {{$e_mail}}</p>
@endisset
@isset($comment)
    <p>Комментарии : {{$comment}}</p>
@endisset

@isset($page)
    <p>Со страницы : {{$page}}</p>
@endisset

@isset($pageLink)
    <p>Ссылка на страницу : <a href="{{$pageLink}}">{{$pageLink}}</a></p>
@endisset
</body>
</html>