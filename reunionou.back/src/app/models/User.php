<?php

namespace reu\back\app\models;

class User extends \Illuminate\Database\Eloquent\Model 
{
    protected $table      = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable= ['id','nom','prenom','mail','sexe','password','dateConnexion'];
    public    $incrementing = false;
    public    $keyType='string';

    public const CREATED = 1;
}
