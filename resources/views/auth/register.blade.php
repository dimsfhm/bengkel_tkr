<form method="POST" action="/register">
    @csrf

    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>