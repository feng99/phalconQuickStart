<?php 

namespace Phalcon\Flash {

	class Direct extends \Phalcon\Flash implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\FlashInterface {

		public function message($type, $message){ }


		public function output($remove=null){ }

	}
}
