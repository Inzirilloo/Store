<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action = "{{route('update', $product)}}" method = "POST">
        @csrf
        {{--@method('PUT')--}}
        Inserisci nuovo content
        <textarea id = "content" name = "content">{{$product->content}}</textarea>
        <button type = "submit">submit</button>
    </form>
</body>
</html>