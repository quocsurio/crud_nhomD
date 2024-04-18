<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //CRUD

    public function addStudent(Request $request)
    {
        // Logic để thêm sinh viên mới
        return view('student.create');
    }
    public function store(Request $request)
    {
        $student = new Student();
        $student->ten = $request->input('ten');
        $student->email = $request->input('email');
        $student->lop = $request->input('lop');
        //
        if($request->hasFile('anhdaidien')){
            $file = $request->file('anhdaidien');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/student/',$filename);//up len thu muc
            $student->anhdaidien = $filename;
        }
        $student->save();
        return redirect()->back()->with('status', 'Thêm Sinh Viên Thành Công!');
    }
    public function index()
    {
        return view('student.index');
    }
    public function edit($id)
    {
        // Logic để chỉnh sửa sinh viên
    }

    public function delete($id)
    {
        // Logic để xóa sinh viên
    }
}
