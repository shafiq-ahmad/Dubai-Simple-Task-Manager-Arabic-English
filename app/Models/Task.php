<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
	public static $statuses = ['Pending','Refused','Approved'];
	protected $guarded = ['id'];
	public function project(){
		return $this->belongsTo(Project::class);
	}
	public function comments(){
		return $this->hasMany(Task_comment::class);
	}
}
