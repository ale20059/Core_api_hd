<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where(function ($query) use ($request) {
            $query->where('email', $request->login)
                ->orWhere('username', $request->login);;
        })->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json([
                'message' => 'Credenciales Incorrectas.'
            ], 401);
        }

        /*

        if (!$student->is_active) {
            return response()->json([
                'message' => 'Tu cuenta está desactivada. Contacta al administrador.'
            ], 403);
        }

        */

        $token = $student->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesion exitoso.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'name' => $student->name,
                'email' => $student->email,
                'username' => $student->username,
            ]
        ], 200);
    }

    public function Register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'username' => 'required|string|unique:students,username|max:255',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $student = Student::create($validated);

        $token = $student->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registro Exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'student' => $student,

        ], 201);
    }

    public function me()
    {
        return response()->json(['message' => 'usuario logeado correctamente']);
    }
}
