<?php 

namespace Phalcon\Mvc {

	abstract class Controller extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\ControllerInterface {

		final public function __construct(){ }

	}
}
