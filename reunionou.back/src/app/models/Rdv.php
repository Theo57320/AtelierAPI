<?php

namespace reu\back\app\models;

class Rdv extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'rdv';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable= ['id','lat','long','libelle_event','libelle_lieu','horraire','date','createur_id'];
    public $incrementing = false;
    protected $keytype = "string";

    public const CREATED = 1;

}
