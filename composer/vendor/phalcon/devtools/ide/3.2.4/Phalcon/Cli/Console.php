<?php 

namespace Phalcon\Cli {

	class Console extends \Phalcon\Application implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_arguments;

		protected $_options;

		public function addModules($modules){ }


		public function handle($arguments=null){ }


		public function setArgument($arguments=null, $str=null, $shift=null){ }

	}
}
