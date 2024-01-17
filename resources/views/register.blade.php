<!DOCTYPE html>
<html>

<body>
    @if($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif
    <h2>Registration Page</h2>

    <form action="{{ route('registration') }}" method="POST">
        @csrf
        name:
        <input type="text" id="name" name="name"><br>
        email:
        <input type="text" id="email" name="email"><br>
        password:
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Submit">
        <br>
        <!-- remember me serve solo se vuoi stare loggato anche dopo che il token expire (2 ore) -->
        
    </form>

    <br>

    <a href="{{ url('/register') }}">
        <button type="submit">
            Edit
        </button>
    </a>

    <p>If you click the "Submit" button, the form-data will be sent to a page called "list".</p>

</body>

</html>