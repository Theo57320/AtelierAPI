<?php

namespace reu\app\app\models;

class Inviter extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'inviter';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_rdv', 'id_user'];


}