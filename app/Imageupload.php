<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imageupload extends Model
{
	protected $fillable = ['image'];

	protected $table = 'categories';
}
