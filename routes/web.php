<?php

use App\Http\Controllers\JobModelController;
use App\Http\Controllers\ProfileController;
use App\Models\JobModel;
use App\Models\Tags;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {

    $jobs = session('filtered') ? session('filtered_jobs') : JobModel::all();

    $tagCount = Tags::count();

    return view('dashboard', ['jobs' => $jobs, 'tagC' => $tagCount]);
})->name('dashboard');


Route::get('/jobbytag/{tags}', function ($tags) {
    $matchedJobs = JobModel::where('tags_id', $tags)->get();
    $otherJobs = JobModel::where('tags_id', '!=', $tags)->get();
    $jobs = $matchedJobs->concat($otherJobs);

    session()->flash('filtered_jobs', $jobs);

    session()->flash('filtered', true);

    return redirect()->route('dashboard');
})->name("jobsbytag");


Route::get('/jobs/{job}', function($job){
    $job = JobModel::find($job);

    return view('jobs.view', ['job'=>$job]);
})->name('viewJob');




Route::post('/tags', function (Request $request) {

    $request->validate(['name' => 'required|string|max:255']);
    $tag = Tags::where('name', $request->name)->first();
    if(!$tag)
        $tag = Tags::create(['name' => $request->name]);
    return response()->json(['success' => true, 'tag' => $tag]);
})->name('tags.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
})->name('profile');

Route::resource('/job', JobModelController::class)->middleware('auth');

Route::get('/job', function () {
    $jobs = JobModel::where("user_id", Auth::id())->get();
    return view('jobs.index', ['jobs' => $jobs]);
})->name('jobs')->middleware('auth');

Route::view('/vacancy', 'vacancy')->name('vacancy');

require __DIR__ . '/auth.php';
