<!DOCTYPE html>
<html>

<body>
    @if($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif
    <h2>Login Page</h2>

    <form action="{{ url('login') }}" method="POST">
        @csrf
        email:
        <input type="text" id="email" name="email"><br>
        password:
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Submit">
        <br>
        <!-- remember me serve solo se vuoi stare loggato anche dopo che il token expire (2 ore) -->
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">Remember me
        </label>
    </form>

    <br>

    <a href="{{ url('/register') }}">
        <button type="submit">
            Registration
        </button>
    </a>

    <p>If you click the "Submit" button, the form-data will be sent to a page called "list".</p>

</body>

</html>