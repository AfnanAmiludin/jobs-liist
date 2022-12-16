<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Categories;
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
            'categori.*' => ['required']
        ]);

        $job = new Jobs();
        $job->job_name = $attribute['job_name'];
        $job->company = $attribute['company'];
        $job->rate = $attribute['rate'];
        $job->sallary = $attribute['sallary'];
        $job->save();

        for ($i = 0; $i < count($attribute['categori']); $i++) {
            $categori = new Categori();
            $categori->jobes_id = $job->id;
            $categori->name_categori = $attribute['categori'][$i];
            $categori->save();
        }

        $job = Jobs::where('id', $job->id)->with('categories')->first();

        return response()->json(['data' => $job]);
    }

    public function show(Jobs $job)
    {
        return response()->json(['data' => $job]);
    }

    public function update(Request $request, Jobs $job)
    {
        $attribute = $request->validate([
            'job_name' => ['required'],
            'company' => ['required'],
            'rate' => ['required'],
            'sallary' => ['required'],
        ]);

        $job->update($attribute);

        return response()->json(['data' => $job]);
    }

    public function destroy(Jobs $job)
    {
        $job->delete();

        return response()->json(['data' => $job]);
    }
}
