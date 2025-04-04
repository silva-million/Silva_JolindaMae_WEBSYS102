@if(session('success'))
<div style="color:green">{{session('success ')}}</div>
@endif
<form action="{{route('logout')}}" method="POST">
    @csrf
    <h1>Welcome</h1>
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
