@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background-color: #f9f5ff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(168, 85, 247, 0.2);">
    <h2 class="text-center mb-4" style="color: #7e22ce;">Add Student</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">First Name</label>
            <input type="text" name="firstname" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Last Name</label>
            <input type="text" name="lastname" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Email</label>
            <input type="email" name="email" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Address</label>
            <textarea name="address" class="form-control" style="border: 1px solid #d8b4fe;" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Student ID</label>
            <input type="text" name="studentID" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Course</label>
            <input type="text" name="course" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #6b21a8;">Year Level</label>
            <input type="text" name="yearlevel" class="form-control" style="border: 1px solid #d8b4fe;" required>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn" style="background-color: #c084fc; color: white; border: none; padding: 10px 30px; border-radius: 30px;">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
