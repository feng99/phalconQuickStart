<?php 

namespace Phalcon\Mvc {

	class Micro extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \ArrayAccess {

		protected $_dependencyInjector;

		protected $_handlers;

		protected $_router;

		protected $_stopped;

		protected $_notFoundHandler;

		protected $_errorHandler;

		protected $_activeHandler;

		protected $_beforeHandlers;

		protected $_afterHandlers;

		protected $_finishHandlers;

		protected $_returnedValue;

		protected $_modelBinder;

		protected $_afterBindingHandlers;

		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function map($routePattern, $handler){ }


		public function get($routePattern, $handler){ }


		public function post($routePattern, $handler){ }


		public function put($routePattern, $handler){ }


		public function patch($routePattern, $handler){ }


		public function head($routePattern, $handler){ }


		public function delete($routePattern, $handler){ }


		public function options($routePattern, $handler){ }


		public function mount(\Phalcon\Mvc\Micro\CollectionInterface $collection){ }


		public function notFound($handler){ }


		public function error($handler){ }


		public function getRouter(){ }


		public function setService($serviceName, $definition, $shared=null){ }


		public function hasService($serviceName){ }


		public function getService($serviceName){ }


		public function getSharedService($serviceName){ }


		public function handle($uri=null){ }


		public function stop(){ }


		public function setActiveHandler($activeHandler){ }


		public function getActiveHandler(){ }


		public function getReturnedValue(){ }


		public function offsetExists($alias){ }


		public function offsetSet($alias, $definition){ }


		public function offsetGet($alias){ }


		public function offsetUnset($alias){ }


		public function before($handler){ }


		public function afterBinding($handler){ }


		public function after($handler){ }


		public function finish($handler){ }


		public function getHandlers(){ }


		public function getModelBinder(){ }


		public function setModelBinder(\Phalcon\Mvc\Model\BinderInterface $modelBinder, $cache=null){ }


		public function getBoundModels(){ }

	}
}
