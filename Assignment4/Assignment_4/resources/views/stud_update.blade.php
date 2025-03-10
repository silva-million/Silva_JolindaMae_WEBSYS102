<form action="/update/{{$users -> id}}" method="post">
    @csrf
    <table>
        <tr>
        <td>
                Old Name: 
            </td>
        <td>
            {{$users->name}}
            </td>
        </tr>
        <tr>
            <td>
                Name
            </td>
            <td>
                <input type="text" name="stud_name">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Update Student">
            </td>
        </tr>
    </table>
</form>