<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    function list(){
        return Student::all();
    }
    public function show($id) {
      // Fetch the student by ID
      $student = Student::find($id);
  
      // Check if the student exists
      if (!$student) {
          return response()->json(['message' => 'Student not found'], 404);
      }
  
      // Return the student data
      return response()->json($student);
  }
  


    function addStudent(Request $request)
{
    // Validation rules
    $rules = [
        'name' => 'required|min:2|max:10',
        'phone' => 'required',
        'father_name' => 'nullable|max:255',
        'roll_no' => 'nullable|integer',
        'address' => 'nullable|max:255',
        'department' => 'nullable|max:255',
    ];

    // Validate request
    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {
        // Return validation errors with a 422 status code
        return response()->json([
            'success' => false,
            'errors' => $validation->errors()
        ], 422);
    }

    try {
        // Create a new student
        $student = new Student();
        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->roll_no = $request->roll_no;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->department = $request->department;

        if ($student->save()) {
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Student added successfully',
                'data' => $student
            ], 201); // 201 = Created
        } else {
            // Handle save failure
            return response()->json([
                'success' => false,
                'message' => 'Failed to add student'
            ], 500); // 500 = Internal Server Error
        }
    } catch (\Exception $e) {
        // Handle unexpected errors
        return response()->json([
            'success' => false,
            'message' => 'An error occurred',
            'error' => $e->getMessage()
        ], 500);
    }
}

     

    function updateStudent(Request $request ){
      try{
      $student=Student::find($request->id);
      $student->name=$request->name;
      $student->father_name=$request->father_name;
      $student->roll_no=$request->roll_no;
      $student->phone=$request->phone;
      $student->address=$request->address;
      $student->department=$request->department;

      if($student->save()){
        return response()->json([
          'success'=> true,
          'message'=> 'Student Updated Successfully',
          'data'=> '$student'
        ], 200);
      }
      else{
        return response()->json([
          'success'=> false,
          'message'=> 'Student is not updated'
        ], 500);
      } 
    }catch (\Exception $e){
        return response()->json([
          'success'=> false,
            'message'=> 'error occures',
            'error'=> $e->getMessage()
        ], 500);
      }

    }

    function deleteStudent($id){
      $student=Student::destroy($id);
      if($student){
        return "Student record deleted";
      }
      else{
        return "Not DEleted";
      }
    }
   
}
