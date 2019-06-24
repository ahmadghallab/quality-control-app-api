<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'criteria';
    protected $fillable = ['name', 'section_id'];
}