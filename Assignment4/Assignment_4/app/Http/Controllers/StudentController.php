<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function insertform(){
        return view('stud_create');
    }

    public function insert(Request $request){
        $name = $request -> input('stud_name');
        DB::insert('insert into student(name) values(?)', [$name]);
        return Redirect('/view-records');
    }

    public function show(){
        $users = DB::select('select * from student');
        return view('stud_view', ['users'=>$users]);
    }

    public function destroy($id){
        DB::delete('delete from student where id = ?', [$id]);
        return Redirect('/view-records');
    }

    public function edit($id){
        $users = DB::select('select * from student where id = ?', [$id]);
        return view('stud_update', ['users' => $users[0]]);
    }

    public function update(Request $request, $id){
        $name = $request -> input('stud_name');
        $student_edit = DB::update('update student set name = ? where id = ?',[$name, $id]);
        return Redirect('/view-records');
    }
}
