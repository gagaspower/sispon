<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class menu_model extends Eloquent {
  
  public function __construct() { 
      parent::__construct(); 
      
  }
  protected $table = 'tbl_menu';
  public $timestamps = false;
 
  
}