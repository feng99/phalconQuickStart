<?php 

namespace Phalcon {

	class Di implements \Phalcon\DiInterface, \ArrayAccess {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected $_eventsManager;

		protected static $_default;

		public function __construct(){ }


		public function setInternalEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getInternalEventsManager(){ }


		public function set($name, $definition, $shared=null){ }


		public function setShared($name, $definition){ }


		public function remove($name){ }


		public function attempt($name, $definition, $shared=null){ }


		public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition){ }


		public function getRaw($name){ }


		public function getService($name){ }


		public function get($name, $parameters=null){ }


		public function getShared($name, $parameters=null){ }


		public function has($name){ }


		public function wasFreshInstance(){ }


		public function getServices(){ }


		public function offsetExists($name){ }


		public function offsetSet($name, $definition){ }


		public function offsetGet($name){ }


		public function offsetUnset($name){ }


		public function __call($method, $arguments=null){ }


		public function register(\Phalcon\Di\ServiceProviderInterface $provider){ }


		public static function setDefault(\Phalcon\DiInterface $dependencyInjector){ }


		public static function getDefault(){ }


		public static function reset(){ }


		public function loadFromYaml($filePath, $callbacks=null){ }


		public function loadFromPhp($filePath){ }


		protected function loadFromConfig(\Phalcon\Config $config){ }

	}
}
