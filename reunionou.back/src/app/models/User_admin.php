<?php

namespace reu\back\app\models;

class user_admin extends \Illuminate\Database\Eloquent\Model 
{
    protected $table      = 'user_admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable= ['mail','password',];
    public    $incrementing = false;

    public const CREATED = 1;
}