<?php 

namespace Phalcon {

	abstract class Application extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_eventsManager;

		protected $_dependencyInjector;

		protected $_defaultModule;

		protected $_modules;

		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function registerModules($modules, $merge=null){ }


		public function getModules(){ }


		public function getModule($name){ }


		public function setDefaultModule($defaultModule){ }


		public function getDefaultModule(){ }


		abstract public function handle();

	}
}
