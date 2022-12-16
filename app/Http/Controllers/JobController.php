<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $job = Jobs::get();

        return response()->json(['data' => $job]);
    }

    public function create(Request $request)
    {
        $attribute = $request->validate([
            'job_name' => ['required'],
            'company' => ['required'],
            'rate' => ['required'],
            'sallary' => ['required'],
        ]);

        $job = Jobs::create($attribute);

        return response()->json(['data' => $job]);
    }

    public function show(Jobs $job)
    {
        return response()->json(['data' => $job]);
    }

    public function update(Request $request, Jobs $job)
    {


        $job->update();

        return response()->json(['data' => $job]);
    }

    public function destroy(Jobs $job)
    {
        $job->delete();

        return response()->json(['data' => $job]);
    }
}
