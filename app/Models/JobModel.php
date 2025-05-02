<?php

namespace App\Models;

use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    use HasFactory;
    protected $table = "jobslist";
    protected $fillable = ['title', 'imageUrl', 'description', 'user_id', 'tags_id', 'salary'];

    // public static function allTypes(){
    //     return ["Frontend Developer", "BackEnd Developer", "Full Stack Engineer", "UI/UX Designer", "Game Developer"]; 
    // }
    // public function getType($id){
    //     $types = $this->allTypes();
    //     return $types[$id];
    // }
    // public function hasType($name){
    //     $types = $this->allTypes();
    //     return in_array($name, $types);
    // }
}
