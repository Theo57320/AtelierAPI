<?php

namespace reu\app\app\models;

class Commenter extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'commenter';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_rdv', 'id_user', 'libelle'];
}
