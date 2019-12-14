<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'id', 'user', 'section_id', 'name', 'map', 'field', 'section', 'path', 'status', 'created_at', 'updated_at'
    ];
}
