<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPhoto extends Model
{
    use HasFactory;
	//protected $table = 'project_photos';
	    protected $fillable = [
        'project_date',
        'title',
        'title_slug',
        'location',
        'details',
        'date_posted',
        'posted_by',
        'date_updated',
        'updated_by'
    ];

}
