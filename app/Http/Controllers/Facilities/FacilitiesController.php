<?php

namespace App\Http\Controllers\Facilities;

use App\Models\Facility\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FacilitiesController extends Controller
{
    /**
     * Show the index page
     * w
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('facilities.facilities');
    }

    /**
     * Add a facility to storage
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFacility(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'facility_name' => 'required|string|max:200',
           'facility_description' => 'required|string|max:255',
           'branches' => 'required|integer'
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('error', 'Input Validation Failed! '.$validator->errors());
        }

        Facility::create([
            'college_id' => Auth::id(),
            'facility_name' => $request->facility_name,
            'facility_description' => $request->facility_description,
            'credits' => 0,
            'certified' => 0,
            'active' => 0
        ]);

        return back()->with('success', 'Facility was added successfully. It will be listed under this profile once approved');

    }
}
