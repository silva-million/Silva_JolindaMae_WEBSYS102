
@if($errors->any())
<div style="color: red">@foreach ($errors->all() as $error)
    <li>{{$error}}</li>
@endforeach</div>
@endif
<br>
<form action="{{route('register')}}" method="POST">
    @csrf
    <div>
        <label for="name">Name: </label>
        <input type="text" name="name" value="{{old('name')}}" required autofocus>
    </div>
    <br>
    <div>
        <label for="email">Email: </label>
        <input type="email" name="email" value="{{old('email')}}" required>
    </div>
    <br>
    <div>
        <label for="password">Password: </label>
        <input type="text" name="password" required>
    </div>
    <br>
    <div>
        <label for="password_confirmation">Confirm Password: </label>
        <input type="password" name="password_confirmation" required>
    </div>
    <br>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
