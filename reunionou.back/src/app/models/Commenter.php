<?php

namespace reu\back\app\models;

class Commenter extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'commenter';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['id_rdv', 'id_user', 'libelle'];
}
