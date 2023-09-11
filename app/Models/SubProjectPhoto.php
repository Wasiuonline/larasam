<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProjectPhoto extends Model
{
    use HasFactory;
	//protected $table = 'project_photos';
	    protected $fillable = [
        'project_id',
        'file_session_no',
        'picture_description',
        'date_posted',
        'posted_by',
        'date_updated',
        'updated_by'
    ];

}
