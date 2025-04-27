@extends('layouts.app')

@section('content')
    <h2>Edit Student</h2>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="firstname" class="form-control" value="{{ $student->firstname }}" required>
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="lastname" class="form-control" value="{{ $student->lastname }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $student->address }}</textarea>
        </div>
        <div class="mb-3">
            <label>Student ID</label>
            <input type="text" name="studentID" class="form-control" value="{{ $student->studentID }}" required>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <input type="text" name="course" class="form-control" value="{{ $student->course }}" required>
        </div>
        <div class="mb-3">
            <label>Year Level</label>
            <input type="text" name="yearlevel" class="form-control" value="{{ $student->yearlevel }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
