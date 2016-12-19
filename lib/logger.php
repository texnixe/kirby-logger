<?php
namespace Logger;

use C;
use Exception;
use F;

require_once(__DIR__ . DS . 'helpers.php');

class Logger {

  private $user;
  private $logfile;

  public function __construct() {
    $this->logfile = c::get('logger.filepath', kirby()->roots()->index() . DS . 'logger/log.txt');
    $this->user = $this->getUser();

    if(! file_exists($this->logfile)) {
      createLogfile($this->logfile);
    }
  }

  public function getUser() {
    return site()->user()? site()->user()->username():'anonymous';
  }

  public function save(...$params) {
    $message = $this->getMessage($params[0], array_slice($params, 1));
    $diff = array();

    if(strpos($params[0], '.update')) {
      $diff = $this->getDiff(array_slice($params, -2)[0], array_slice($params, -1)[0]);
    }


    $file = $this->logfile;
    $data = array(
      'user' => $this->getUser(),
      'date' => date('Y-m-d'),
      'time' => date('H:i:s'),
      'message' => $message,
      'changed' => !empty($diff)? implode('|', $diff): ''
    );

    $data = implode(', ', $data) . "\n";
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

  }

  protected function getMessage($key, $params) {
    array_unshift($params, translation($key));
    return sprintf(...$params);
  }

  protected function getDiff($new, $old) {

    $diff = array();

    foreach($new as $field => $value) {
      if(isset($old[$field])) {
        if($value !== $old[$field]) {
          $diff[] = $field;
        }
      }
    }
    return $diff;
  }

}
