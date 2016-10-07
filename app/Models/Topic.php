<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

	protected $fillable = [
		'title',
		'slug',
		'body',
		'section_id'
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function section()
    {
    	return $this->belongsTo(Section::class);
    }

    public function topics()
    {
        return $this->hasMany(User::class);
    }
}
