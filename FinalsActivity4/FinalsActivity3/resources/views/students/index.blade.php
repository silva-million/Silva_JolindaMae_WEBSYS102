@extends('layouts.app')

@section('content')
    <h2>Student List</h2>
    <a href="{{ route('students.create') }}" class="button">Add Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle text-center">
        <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>QR Code</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->yearlevel }}</td>
                <td>{!! $student->qr !!}</td>
                <td>
                    <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
