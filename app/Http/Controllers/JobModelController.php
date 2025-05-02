<?php

namespace App\Http\Controllers;

use App\Models\JobModel;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobModelController extends Controller
{
    use AuthorizesRequests;

    public function index(Auth $auth)
    {
        $jobs = JobModel::where("user_id",Auth::id())->get();
        return view("jobs.index",["jobs" => $jobs]);
    }

    public function show(JobModel $job){
        $jobs = JobModel::find($job);
        return view("job",["jobs" => $jobs]);
    }

    public function create()
    {
        $types = Tags::all();
        return view("jobs.create", ["types"=>$types]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "imageUrl" => ["required", "url"],
            "title" => ["required", "min:3"],
            "description" => ["required","min:10"],
            "salary" => ["required","numeric"],
            "tag_id" => ["required","numeric"],
        ]);
        
        $job = JobModel::create([
            
            'imageUrl' => $validate["imageUrl"],
            'title' => $validate['title'],
            'description'=> $validate['description'],
            'salary' => $validate['salary'],
            'user_id' => Auth::id(),
            'tags_id' => $validate['tag_id']
        ]);

        session()->flash('success', 'Job created successfully!');
        return redirect('/job');
    }

    public function edit(JobModel $job)
    {
        // dd($job);
        // $this->authorize('update', $job);
        if (!($this->authorize('update', $job))) {
            abort(403);
        }

        $types = Tags::all();
        // dd($techs[0]->name);
        return view('jobs.edit', ['job' => $job, 'types' => $types]);
    }

    public function update(Request $request, JobModel $job)
    {
        $validate = $request->validate([
            "imageUrl" => ["required", "url"],
            "title" => ["required", "min:3"],
            "description" => ["required","min:10"],
            "salary" => ["required","numeric"],
            "tag_id" => ["required","numeric"],
        ]);
        
        $job->update([
            'imageUrl' => $validate["imageUrl"],
            'title' => $validate['title'],
            'description'=> $validate['description'],
            'salary' => $validate['salary'],
            "tags_id" => $validate["tag_id"],
        ]);
        
        session()->flash('success', 'Job updated successfully!');
        return redirect('/job');
    }

    public function destroy(JobModel $job)
    {
        if(!($this->authorize('delete', $job))) {
            abort(403);
        }
        $job->delete();
        session()->flash('success', 'Job deleted successfully!');
        return redirect('/job');
    }
}
