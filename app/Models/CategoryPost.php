<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_post'; //this is the table that this midel should interact
    protected $fillable = ['post_id', 'category_id']; //these are the columns names of the table
    public $timestamps = false; //set to false because we don't need to use it
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}


