<?php 

namespace Phalcon\Flash {

	class Session extends \Phalcon\Flash implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\FlashInterface {

		protected function _getSessionMessages($remove, $type=null){ }


		protected function _setSessionMessages($messages){ }


		public function message($type, $message){ }


		public function has($type=null){ }


		public function getMessages($type=null, $remove=null){ }


		public function output($remove=null){ }


		public function clear(){ }

	}
}
