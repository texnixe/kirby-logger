<?php

use Kirby\Panel\View;
use Kirby\Panel\Topbar;

use Kirby\Panel\Models\Logger;

class LoggerController extends Kirby\Panel\Controllers\Base {

  public function index() {
    $logger   = new Logger;
    $content = new View('mvc/view', ['changes' => $logger->getChanges()]);
    $content->_root = dirname(__DIR__);

    return $this->layout('app', [
      'topbar'  => new Topbar('logger', $logger),
      'content' => $content
    ]);
  }

}
