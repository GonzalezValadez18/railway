<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $data = [
            'students' => $students,
            'message' => 'success'
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'languaje' => 'required'
        ]);
        
        if ($validator->fails()) {
            $data = [
                'message' => 'error',
                'errors' => $validator->errors()
            ];
            return response()->json($data);
        } 
        $student = Student::create($request->all());

        if (!$student) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data);

        }

        $data = [
            'student' => $student,
            'message' => 'Insert success'
        ];

        return response()->json($data);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if(!$student) {
            $data = [
                'message' => 'No se encontró el estudiante',
                'status' => 404
            ];
            return response()->json($data);
        }

        $data = [
            'student' => $student,
            'message' => 'success'
        ];
        return response()->json($data);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student) {
            $data = [
                'message' => 'No se encontró el estudiante',
                'status' => 404
            ];
            return response()->json($data);
        }

        $student->delete();

        $data = [
            'student' => $student->name,
            'message' => 'Delete success'
        ];
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student) {
            $data = [
                'message' => 'No se encontró el estudiante',
                'status' => 404
            ];
            return response()->json($data);
        }

        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'languaje' => 'required'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->languaje = $request->languaje;

        $student->save();

        $data = [
            'student' => $student,
            'message' => 'Update success'
        ];

        return response()->json($data);
        
    }

    public function updatePartial(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student) {
            $data = [
                'message' => 'No se encontró el estudiante',
                'status' => 404
            ];
            return response()->json($data);
        }

        $validator = Validator::make($request->all(), [
            'name' => '',
            'email' => 'email',
            'phone' => 'numeric',
            'languaje' => ''
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 400);
        }

        if($request->has('name')) {
            $student->name = $request->name;
        }
        if($request->has('email')) {
            $student->email = $request->email;
        }
        if($request->has('phone')) {
            $student->phone = $request->phone;
        }
        if($request->has('languaje')) {
            $student->languaje = $request->languaje;
        }

        $student->save();
        $data = [
            'student' => $student,
            'message' => 'Update partial success'
        ];

        return response()->json($data);
    
    }
    
}