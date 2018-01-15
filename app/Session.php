<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	protected $table = 'sessions';
	protected $fillable = [
		'user_id',
		'token'
	];

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function isValid()
	{
		return true;
	}	
}