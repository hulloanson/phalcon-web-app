<?php
/**
 * Created by: ycl
 * Date: 6/6/2017
 * Time: 3:29 PM
 */

namespace Backend\Controllers;


class Test extends BackendController
{
  public function getAllAction() {
    self::sendJSON(['msg' => 'Gotta get \'em all!']);
  }

  public function addNewAction() {
    self::sendJSON(['msg' => 'Fresh as new']);
  }

  public function deleteAllAction() {
    self::sendJSON(['msg' => 'Dropping BOMB']);
  }
}