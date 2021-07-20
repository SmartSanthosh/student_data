<?php
namespace App\Http\Controllers\API;

use App\Models\Student; 
use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller 
{
  	public function login(Request $request){ 
		$credentials = [
			'email'	   => $request->email, 
			'password' => $request->password
		];

		if( auth()->attempt($credentials) ){ 
			$user = Auth::user(); 
				$success['token'] =  $user->createToken('AppName')->accessToken; 
				return response()->json(['success' => $success], 200);
		} 
		else { 
			return response()->json(['error'=>'Unauthorised'], 401);
		} 
	}
    
   //store or update the student record

  	public function store(Request $request) 
  	{
		if($request->id){
			$student = Student::findorFail($request->id);
			$student->update($request->except('_token'));
		}
		else{
			$student = Student::create($request->except('_token'));
		}
		return response()->json(['success'=>$student],200); 
	}
    
	//Edit the student record

	public function edit($id){
		$student = Student::findorFail($id);
		return Response()->json(['success'=>$student],200);
	}
    
	//Delete the student record

	public function destroy($id){
		$student = Student::findorFail($id)->delete();
		return Response()->json(['success'=>$student],200);
	}
}
?>