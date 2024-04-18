<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $student = Student::all();
        return view('student.index',compact('student'));
    }
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
            
        // Logic để chỉnh sửa sinh viên
    }
    public function update(Request $request, $id)
    {
        //tim theo id
        $student = Student::find($id);
        $student->ten = $request->input('ten');
        $student->email = $request->input('email');
        $student->lop = $request->input('lop');
        if($request->hasFile('anhdaidien')){
            $anhcu = 'uploads/student/'.$student->anhdaidien;
            if (File::exists($anhcu)){
                File::delete($anhcu);
            }
            $file = $request->file('anhdaidien');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/student/',$filename);//up len thu muc
            $student->anhdaidien = $filename;
        }
        $student->update();
        return redirect()->back()->with('status', 'Cập nhật Sinh Viên Thành Công!');

            
        // Logic để chỉnh sửa sinh viên
    }

    public function delete($id)
{
    $student = Student::find($id);

    // Kiểm tra xem sinh viên có tồn tại hay không
    if (!$student) {
        return redirect()->back()->with('error', 'Sinh viên không tồn tại');
    }

    $anhdaidien = 'uploads/student/'.$student->anhdaidien;

    // Kiểm tra xem tệp ảnh có tồn tại hay không
    if (File::exists($anhdaidien)) {
        File::delete($anhdaidien);
    }

    $student->delete();

    return redirect()->back()->with('status','Xóa sinh viên thành công');
}

}
