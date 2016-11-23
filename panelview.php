<?php
namespace Logger;

use \Kirby\Panel\Topbar;
use \l;
use \r;
use \f;
use \c;

if(class_exists('Panel')) {
	class LoggerController extends \Kirby\Panel\Controllers\Base {
		public function view($file, $data = array()) {
			return new LoggerView($file, $data);
		}
		public function getChanges() {
			$filepath = panel()->site()->kirby()->roots()->index() . DS . "logger/log.txt";
			$entries = c::get('logger.entries', 50);
			$changes = tail($filepath, $entries);

			return compact('changes', 'entries');
		}

		public function index() {
			return $this->screen('index', new TopbarGenerator(), $this->getChanges());
		}


	}
	class TopbarGenerator {
		public function topbar(Topbar $topbar) {
			$topbar->append(panel()->site()->url() . '/panel/logger', 'Logger');
		}
	}
	class LoggerView extends \Kirby\Panel\View {
		public function __construct($file, $data = array()) {
			parent::__construct($file, $data);
			$this->_root = __DIR__ . DS . 'views';
		}
	}
	$panel = panel();

	$panel->routes[] = [
		'pattern' => 'logger',
		'action'  => function() {
			$ctrl = new LoggerController();
			return $ctrl->index();
		},
		'method'  => 'GET',
		'filter'  => array('auth')
	];
}
