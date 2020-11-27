<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	protected $table = 'todos';
    protected $primaryKey = "id_todos";
    protected $fillable = [
    	'name',
    	'start_date',
    	'end_date',
    	'proggress',
    	'create_by',
    	'update_by',
    	'delete_by',
    	'delete',
    	'user_id',
    ];
}
