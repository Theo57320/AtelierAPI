<?php

namespace reu\app\app\models;

class Participer extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'participer';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_rdv', 'id_user'];

   
}
