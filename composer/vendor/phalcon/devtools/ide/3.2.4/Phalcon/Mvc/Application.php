<?php 

namespace Phalcon\Mvc {

	class Application extends \Phalcon\Application implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_implicitView;

		public function useImplicitView($implicitView){ }


		public function handle($uri=null){ }

	}
}
