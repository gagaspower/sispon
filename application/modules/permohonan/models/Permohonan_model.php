<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class permohonan_model extends Eloquent {
  
  public function __construct() { 
      parent::__construct(); 
      
  }
  protected $table = 'tbl_permohonan';
  public $timestamps = false;
  
}