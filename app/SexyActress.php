<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SexyActress extends Model
{
 	protected $table = 'sexy_actresses';
	protected $fillable = ['category_id', 'name', 'image_name', 'introduction', 'feature', 'purchase_link', 'searched_count'];
}
