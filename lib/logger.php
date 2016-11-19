<?php
namespace Logger;

use C;
use Exception;
use F;


class Logger {

  private $user;
  private $logfile;

  public function __construct() {
    $this->logfile = c::get('logger.filepath', kirby()->roots()->index() . DS . 'logger/log.txt');
    $this->user = $this->getUser();

    if(! file_exists($this->logfile)) {
      try {
        f::write($this->logfile, '');
      } catch(Exception $e) {
        throw new Exception('The file does not exist');
      }
    }
  }

  public function getUser() {
    return site()->user()? site()->user()->username():'anonymous';
  }

  public function save(...$params) {
    $message = $this->getMessage($params[0], array_slice($params, 1));

    $file = $this->logfile;
    $data = array(
      'user' => $this->getUser(),
      'date' => date('Y-m-d'),
      'time' => date('H:i:s'),
      'message' => $message
    );
    $data = implode(', ', $data) . "\n";
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

  }

  protected function getMessage($key, $params) {

    $translation = c::get('logger.translation', false);
    if (! $translation) {
      $translations = require __DIR__.DS.'translations.php';
      $language = kirby()->option('panel.language', 'en');
      if (! array_key_exists($language, $translations)) {
        $language = 'en';
      }
      $translation = $translations[$language];
    }
    array_unshift($params, $translation[$key]);
    return sprintf(...$params);
  }

}
