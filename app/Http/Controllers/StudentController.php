<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   
    public function index(){
        $students = Student::all();
        return response()->json($students, 200);
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'course' => 'required',
            'age' => 'required',
            'score' => 'required'
        ]);

        $input = $request->all();
        $student = Student::create($input);
        $response = [
            'student' => $student,
            'message' => 'student created successfully'
        ];
        return response()->json($response, 201);
    }

    
    public function show($id){
        $student = Student::find($id);
        if(!$student){
            return response()->json(['message' => 'student not found'], 404);
        }

        return response()->json($student, 200);
    }

   
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id){
       $validator = validator($request->all(), [
            'name' => 'required',
            'course' => 'required',
            'age' => 'required',
            'score' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed'], 422);
        }
        
        $student = Student::find($id);
        
        if(!$student){
            return response()->json(['message' => 'student not found'], 404);
        }

        $data = $request->all();
        $student->update($data);

        $response = [
            'student' => $student,
            'message' => 'student updated successfully'
        ];

        return response()->json($response, 200);
    }

    
    public function destroy(string $id){
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'student deleted successfully'], 200);
    }
}
