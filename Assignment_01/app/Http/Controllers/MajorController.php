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
     * major list function
     */
    public function majorList()
    {
        $majors = $this->majorService->getMajors();
        return view('major.list', compact('majors'));
    }
    /**
     * major createPage function
     */
    public function MajorCreatePage()
    {
        return view('major.create');
    }

    /**
     * major createPage function
     */
    public function majorCreate(Request $request)
    {
        Validator::make($request->all(), [
            'majorName' => 'required',
        ], [
            'majorName.required' => 'Major Name field is required!',
        ])->validate();

        $data = [
            'name' => $request->majorName,
        ];

        $this->majorService->createMajor($data, $request);

        return redirect()->route('major#list')->with(['createSuccess' => 'Successfully Created!']);

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
        return redirect()->route('major#list')->with(['updateSuccess' => 'Updated successfully!']);

    }
    /**
     * major delete function
     */
    public function majorDelete($id)
    {
        $this->majorService->deleteMajorById($id);
        return redirect()->route('major#list')->with(['deleteSuccess' => 'Successfully deleted!']);

    }
}