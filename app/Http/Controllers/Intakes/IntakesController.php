<?php

namespace App\Http\Controllers\Intakes;

use App\Models\Intakes\Intakes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IntakesController extends Controller
{
    /**
     *Show index page
     */
    public function index()
    {
        return view('intakes.intakes');
    }

    /**
     *Add an intake date to storage
     */
    public function addIntake(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intake_alias' => 'required|string|max:120',
            'intake_description' => 'required|string|max:120',
            'intake_start' => 'required|string',
            'intake_finish' => 'required|string',
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('error', 'Input Validation Failed! '.$validator->errors());
        }

        Intakes::create([
            'college_id' => Auth::id(),
            'intake_alias' => $request->intake_alias,
            'intake_description' => $request->intake_description,
            'intake_start' => $request->intake_start,
            'intake_finish' => $request->intake_finish
        ]);

        return back()->with('success', 'Intake was successfully added.');
    }
}
