<?php

namespace App\Http\Controllers;
use App\Models\Student;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
	    $students = Student::all()->map(function ($student) {
        $student->qr = QrCode::size(100)->generate(json_encode([
                'id' => $student->id,
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'email' => $student->email,
                'address' => $student->address,
                'studentID' => $student->studentID,
                'course' => $student->course,
                'yearlevel' => $student->yearlevel,
            ]));

            return $student;
        });

        $query = Student::query();

        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students',
            'address' => 'required',
            'studentID' => 'required|string|unique:students',
            'course' => 'required',
            'yearlevel' => 'required',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created.');
    }

    public function show(Student $student)
    {
        $qr = QrCode::size(200)->generate(json_encode([
            'id' => $student->id,
            'firstname' => $student->firstname,
            'lastname' => $student->lastname,
            'email' => $student->email,
            'address' => $student->address,
            'studentID' => $student->studentID,
            'course' => $student->course,
            'yearlevel' => $student->yearlevel,
        ]));

        return view('students.show', compact('student', 'qr'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students',
            'address' => 'required',
            'studentID' => 'required|string|unique:students',
            'course' => 'required',
            'yearlevel' => 'required',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
