<form action="/create" method="post">
    @csrf
    <table>
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
                <input type="submit" value="Add student">
            </td>
        </tr>
    </table>
</form>