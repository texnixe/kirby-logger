<?php

/**
 * Kirby Logger Plugin
 *
 * @version   1.0.0
 * @author    Sonja Broda <info@texniq.de>
 * @copyright Pedro Borges <info@texniq.de>
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
