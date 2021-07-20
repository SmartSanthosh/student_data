<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $fillable=['firstname','lastname','regno','age','gender','department','email','phono','address'];

    function createStudent($student){
        $student = Student::Create($student);
        dd($student['firstname'].' '. $student['lastname']); //concatination of student firstname and student lastname
        return $student;
    }
    function updateStudent($data){
        $student = Student::findorFail($data["id"]); 
        $student->update($data); 
            return $student;
    }
    function editStudent($id){
        $student = Student::find($id);
            return $student;
    }
    function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
            return $student;
    }

    // function scopegetStudent($query){       
    //     // dd($query);

    //     // DB::raw("CONCAT(contact.first_name,' ',contact.last_name) as full_name"));
 
       
    //         // return $query->where('id', 7);
    //         if (@$conditions['search']) {
    //             $search = $conditions['search'];
     
    //             $query->where(function ($query) use ($search) {
    //                 $query->where('id', 'like', '%' . $search . '%');
                       
    //             });
    //         }  
    //         return $query->get()->toArray();
    // }
} 
