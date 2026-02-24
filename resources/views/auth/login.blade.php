<form method="POST" action="/login">
    @csrf

    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Login</button>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
</form>