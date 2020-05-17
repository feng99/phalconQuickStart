<?php 

namespace Phalcon\Di {

	abstract class Injectable implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function __get($propertyName){ }

	}
}
