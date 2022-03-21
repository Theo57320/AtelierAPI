<?php

namespace reu\app\app\models;

class Rdv extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'rdv';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keytype = "int";
}
