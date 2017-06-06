<?php

namespace Frontend\Controllers;

use Phalcon\Mvc\View;

class IndexController extends ViewController {

    public function indexAction() {
        $this->view->title = "Home";
        $this->view->page_css = [
            'local' => [],
          'external' => []
        ];
        $this->view->page_js = [
            'local' => [],
          'external' => []
        ];
    }

}
