<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;
	protected $guard = 'company';
	
	public $timestamps = false;
    protected $fillable = [
        'title',
        'login'
    ];
	
    protected $hidden = [
        //'login'
    ];

	public function projects(){
		return $this->hasMany(Project::class);
	}
}
