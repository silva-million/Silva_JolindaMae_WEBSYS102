<a href="/insert">Create New</a>
<br>
<br>
<table border =1 >
    <tr>
        <td><h3>ID</h3></td>
        <td><h3>Name</h3></td>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td><a href='delete/{{$user->id}}'>Delete</a></td>
        <td><a href='edit/{{$user->id}}'>Edit</a></td>
    </tr>
    @endforeach
</table>
