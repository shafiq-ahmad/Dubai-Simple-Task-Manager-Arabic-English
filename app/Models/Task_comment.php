<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_comment extends Model
{
    use HasFactory;
	protected $guarded = ['id'];
	public function task(){
		return $this->belongsTo(Task::class);
	}
}
