<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MajorServiceInterface;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    private $majorService;
    /**
     * create a new controller instance
     * @param MajorServiceInterFace $MajorServiceInterface
     */

    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }
    /**
     * major index function
     */
    public function index()
    {
        $majors = $this->majorService->getMajors();
        return view('major.index', compact('majors'));
    }
    /**
     * major create function
     */
    public function majorCreate()
    {
        return view('major.create');
    }

    /**
     * major createPage function
     */
    public function majorStore(Request $request)
    {
        Validator::make($request->all(), [
            'majorName' => 'required|unique:majors,name',
        ], [
            'majorName.required' => 'Major Name field is required!',
        ])->validate();

        $data = [
            'name' => $request->majorName,
        ];

        $this->majorService->createMajor($data, $request);

        return redirect()->route('major.index')->with(['createSuccess' => 'Successfully Created!']);

    }
    /**
     * major edit Page
     */
    public function majorEdit($id)
    {
        $major = Major::where('id', $id)->first();
        return view('major.edit', compact('major'));
    }

    /**
     * update function
     */
    public function majorUpdate(Request $request, $id)
    {
        Validator::make($request->all(), [
            'majorName' => 'required',
        ], [
            'majorName.required' => 'Major Name field is required!',
        ])->validate();

        $data = [
            'name' => $request->majorName,
        ];
        $this->majorService->updateMajor($data, $id);
        return redirect()->route('major.index')->with(['updateSuccess' => 'Updated successfully!']);

    }
    /**
     * major delete function
     */
    public function majorDestroy($id)
    {
        $this->majorService->deleteMajorById($id);
        return redirect()->route('major.index')->with(['deleteSuccess' => 'Successfully deleted!']);

    }
}