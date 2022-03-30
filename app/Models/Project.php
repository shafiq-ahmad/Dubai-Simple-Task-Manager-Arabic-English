<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'title',
        'desc',
        'deadline',
        'created_at',
        'updated_at'
    ];
	public function company(){
		return $this->belongsTo(Company::class);
	}
	
	public function tasks(){
		return $this->hasMany(Task::class);
	}
}
