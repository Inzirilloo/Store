<!DOCTYPE html>
<html>

<body>
    @if($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif
    <h2>HTML Forms</h2>

    Welcome {{ $user->name}}
    <form action="{{route('logout') }}" method="GET">
        <button type="submit">
        Schiaccia per logout
        </button>
    </form>
</body>

</html>