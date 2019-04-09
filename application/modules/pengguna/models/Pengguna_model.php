<?php

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model as Eloquent;

class pengguna_model extends Eloquent {
  
  public function __construct() { 
      parent::__construct(); 
      
  }
  protected $table = 'users';
  public $timestamps = false;
  protected $fillable = ['nama','email','password'];
 
  
}