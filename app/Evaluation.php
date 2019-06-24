<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['health_office_id', 'section_id', 'criteria_id', 'score'];
}