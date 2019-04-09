<?php

use Jenssegers\Blade\Blade;

if(!function_exists('view')){
  function view($view, $data = []) {
    $view = str_replace('/', '.', $view);
    $view_path = explode('.', $view);

    $module = $view_path[0];
    $view_name = $view_path[1];

    $path = APPPATH . "modules/{$module}/views/";
    $blade = new Blade($path, APPPATH . 'cache');
    echo $blade->make($view_name, $data);
  }
}