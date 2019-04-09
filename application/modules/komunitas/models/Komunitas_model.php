<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class komunitas_model extends Eloquent {
  
  public function __construct() { 
      parent::__construct(); 
      
  }
  protected $table = 'tbl_komunitas';
  public $timestamps = false;
 
  
}