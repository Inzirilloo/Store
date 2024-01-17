<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>{{auth()->user()->name}}</h2>
    Crea un nuovo prodotto
    <hr>
    <form action = "{{route('store')}}" method = "POST">
        @csrf        
<br>
        {{--@method('PUT')--}}
        Inserisci un nome
        <br>
        <textarea id = "name" name = "name"></textarea>
        <br>
        Inserisci un content
        <br>
        <textarea id = "content" name = "content"></textarea>
        <br>
        Inserisci un prezzo
        <br>
        <input type = "numeber" id = "price" name = "price">
        <button type = "sumbit" name = "user_id" id = "user_id" value = "{{auth()->user()->id}}">invia</button>
        
    </form>
</body>
</html>