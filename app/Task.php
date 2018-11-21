<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public $timestamps = false;
	protected $fillable = ['user_id','title','is_complete','created_at','updated_at'];
}