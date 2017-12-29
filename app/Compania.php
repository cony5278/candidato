<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'imagen',  'codigo','id_ano','id_mes'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'id','id_ano','id_mes'
    ];
}
