<?php 

namespace Phalcon\Mvc\Router {

	class Annotations extends \Phalcon\Mvc\Router implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Di\InjectionAwareInterface {

		const URI_SOURCE_GET_URL = 0;

		const URI_SOURCE_SERVER_REQUEST_URI = 1;

		const POSITION_FIRST = 0;

		const POSITION_LAST = 1;

		protected $_handlers;

		protected $_controllerSuffix;

		protected $_actionSuffix;

		protected $_routePrefix;

		public function addResource($handler, $prefix=null){ }


		public function addModuleResource($module, $handler, $prefix=null){ }


		public function handle($uri=null){ }


		public function processControllerAnnotation($handler, \Phalcon\Annotations\Annotation $annotation){ }


		public function processActionAnnotation($module, $namespaceName, $controller, $action, \Phalcon\Annotations\Annotation $annotation){ }


		public function setControllerSuffix($controllerSuffix){ }


		public function setActionSuffix($actionSuffix){ }


		public function getResources(){ }

	}
}
