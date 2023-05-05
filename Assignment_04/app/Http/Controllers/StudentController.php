<?php

namespace App\Http\Controllers;

use App\Contracts\Services\StudentServiceInterface;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentService;
    /**
     * create a new controller instance
     * @param StudentServiceInterFace $StudentServiceInterface
     */

    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentService = $studentServiceInterface;
    }
    /**
     * index page
     */
    public function index()
    {
        $students = $this->studentService->getStudents();
        return view('student.index', compact('students'));
    }
    /**
     * create page
     */
    public function create()
    {
        $majors = Major::select('id', 'name')->get();
        return view('student.create', compact('majors'));
    }

    /**
     * student create
     */
    public function store(Request $request)
    {

        if ($request->studentName == "") {
            return "Field name is required!";
        }
        $data = [
            'name' => $request->studentName,
            'major_id' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];
        $this->studentService->createStudent($data, $request);

        return redirect()->route('student.index')->with(['createSuccess' => 'Successfully Created!']);

    }
    /**
     * edit function
     */
    public function edit($id)
    {
        $student = Student::where('id', $id)->first();
        $majors = Major::get();
        return view('student.edit', compact('student', 'majors'));
    }

/**
 * update function
 */
    public function update(Request $request, $id)
    {
        if ($request->studentName == "") {
            return "Field name is required!";
        }

        $data = [
            'name' => $request->studentName,
            'majors' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];
        $this->studentService->updateStudent($data, $id);

    }

    /**
     * delete function
     */
    public function destroy($id)
    {
        $this->studentService->deleteStudentById($id);
        return redirect()->route('student.index')->with(['deleteSuccess' => 'Successfully deleted!']);

    }

}
