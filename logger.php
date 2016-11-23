<?php


/**
 * Kirby Logger Plugin
 *
 * @version   1.1.0
 * @author    Sonja Broda <info@texniq.de>
 * @copyright Sonja Broda <info@texniq.de>
 * @link      https://github.com/texnixe/kirby-logger
 * @license   MIT
 */


require_once(__DIR__ . DS . 'lib' . DS . 'logger.php');


function logger() {
    return new Logger\Logger();
}

require_once(__DIR__.DS.'lib'.DS.'hooks.php');
require_once(__DIR__ . DS . 'panelview.php');
require_once(__DIR__ . DS . 'lib' . DS . 'helpers.php');

// Load widgets
if(site()->user() && site()->user()->role() == 'admin') {
  kirby()->set('widget', 'logger', __DIR__. DS . 'widgets' . DS . 'logger');
}

// Add routes
kirby()->routes([[
  'pattern' => 'logger/api/delete',
  'method' => 'GET',
  'action' => function() {

    $user = site()->user()->current();
    $message = '';
    if (!$user || !$user->hasRole('admin')) {
      return Response::error("Must be authenticated as user with page creation permissions");
    }
    $filepath = c::get('logger.filepath', kirby()->roots()->index() . DS . 'logger/log.txt');
    if(file_exists($filepath)) {
      try {
        f::write($filepath, '');
        $message = "The file was successfully reset";
      } catch(Exception $e) {
        $message = "The file could not be reset";
      }

    }
    // Response data
    $data = ['message' => $message];


    return Response::success("File reset", $data);
  },
]]);
