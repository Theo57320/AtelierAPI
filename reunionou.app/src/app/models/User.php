<?php
namespace reu\app\app\models;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $fillable= ['id','nom','prenom','mail','sexe','password'];
    public    $incrementing = true;
    public    $keyType='int'; 
}
