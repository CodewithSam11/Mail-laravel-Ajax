<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class StudentCrudController extends Controller
{
    public function create() {
        return view('studentCrud.create');
    }

    public function store(Request $request)
    {
        // $file = $request->file('file');

        $file = $request->image_path;

        $fileName = time().''.$file->getClientOriginalName();

        $filePath = Storage::disk('public')->putFileAs('images', $file, $fileName);     //storage facades

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image_path = $filePath;
        $student->save();

        return response()->json([
            'response' => 'Student created successfully'
        ]);
    }

    public function viewStudents()
    {
        $students  = Student::all();

        return response()->json([
            'students' => $students
        ]);
    }

    public function editStudent($id)
    {
        $student = Student::where('id',$id)->first();
        return view('studentCrud.edit',compact('student'));
    }

    public function update(Request $request)
    {   //dd($request->all());
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;

        if($request->file('image_path')) {
            $file = $request->file('image_path');
            $fileName = time().''.$file->getClientOriginalName();
            $filePath = Storage::disk('public')->putFileAs('images', $file, $fileName);
            $student->image_path = $filePath;
        }

        $student->save();

        return response()->json([
            'response' => 'Data updated successfully']);
    }

    public function destroy($id)
    {
        Student::where('id',$id)->delete();

        return response()->json(['response' => 'Student deleted successfully']);
    }
}
