<?php

namespace Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ViewController extends Controller
{
  protected $global_css = [
      'local' => ['bootstrap.min', 'font-awesome.min'],
      'external' => []
  ];

  protected $global_js = [
      'local' => ['jquery.min'],
      'external' => []
  ];

  protected $title = "JNL CR";

  public function initialize()
  {
    $this->view->global_js = $this->global_js;
    $this->view->global_css = $this->global_css;
    $this->view->title = $this->title;
  }

  public function indexAction()
  {

  }
}