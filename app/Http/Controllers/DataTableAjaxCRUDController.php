<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StudentStoreRequest;
use Datatables;
use Illuminate\Http\Request;
use  App\Http\Middleware\Localization;
use App;
use DB;

class DataTableAjaxCRUDController extends Controller
{
    public $Student;
    public function __construct(Student $Studentmodel)
    {
        $this->Student = $Studentmodel;
    }

    public function create(){
        // dd("hello");
        return view('students/createstudent');
        // return view('students.createstudent');
    }

    // show all student record
    public function index(Request $request)
    {
        // $s = Student::get()->toArray();
        // dd($s);
        //   $student = $request->get();
        //   dd($student);
        //   $fullname = (object)($student);
        //   dd($fullname);
        //   dd($student[0]->firstname);
        //   dd(($student['firstname']).' '.($student->lastname));
       
        // dd($request);
        // $fullname= ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
        // dd($fullname);
        // $post = Student::where([

        // ]);
        // dd($post);
        // if (@$conditions['search']) {
        //     $search = $conditions['search'];
 
        //     $query->where(function ($query) use ($search) {
        //         $query->where('id', 'like', '%' . $search . '%');
        //     });
        // }  
        // dd($post);

        if (request()->ajax()) {
            return datatables()->of(Student::get())
                ->addColumn('action', 'students/student-action')
                ->addColumn('checkbox', '<input type="checkbox" name="student_checkbox[]" class="student_checkbox" value="{{$id}}"/>')
                ->rawColumns(['action', 'checkbox'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('students/students');
    }

    //localization (Tranlation)

    public function studentList($locale)
    {
            App::setlocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        // app()->setLocale($locale);
        //  app()->setLocale(session('locale',$locale));
        // return view('students/students');
    }

    //insert or update the student record

    public function store(StudentStoreRequest $request)
    { 
        
        try {
            if ($request->id) {
                $student = $this->Student->updateStudent($request->except('_token'));
            } else {
                $student = $this->Student->createStudent($request->except('_token'));
            }
            return Response()->json($student);
        } catch (Exception $e) {
            return Response()->json($e);
        }
    }

    // Edit the student record

    public function edit(Request $request)
    {
        try {
            $student = $this->Student->editStudent($request->id);
            return Response()->json($student);
        } catch (Exception $e) {
            return Response()->json($e);
        }
    }

    //Delete the student record

    public function destroy(Request $request)
    {
        try {
            $student = $this->Student->deleteStudent($request->id);
            return Response()->json($student);
        } catch (Exception $e) {
            return Response()->json($e);
        }
    }

    //Multiple Delete the student record

    public function allDelete(Request $request)
    {
        $student_id_array = $request->input('id');
        $student = Student::whereIn('id', $student_id_array);
        if ($student->delete()) {
            echo "Data Deleted";
        }
    }

    // custom search button 
    public function search(Request $request){
        $search = $request->get('search');
        $students = Student::where('firstname','like','%'.$search.'%')->get()->toArray();
        dd($students);
        return view('students/students',['students'=>$students]);        
    }
}
 