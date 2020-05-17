<?php 

namespace Phalcon\Mvc {

	class Router implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Events\EventsAwareInterface {

		const URI_SOURCE_GET_URL = 0;

		const URI_SOURCE_SERVER_REQUEST_URI = 1;

		const POSITION_FIRST = 0;

		const POSITION_LAST = 1;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_uriSource;

		protected $_namespace;

		protected $_module;

		protected $_controller;

		protected $_action;

		protected $_params;

		protected $_routes;

		protected $_matchedRoute;

		protected $_matches;

		protected $_wasMatched;

		protected $_defaultNamespace;

		protected $_defaultModule;

		protected $_defaultController;

		protected $_defaultAction;

		protected $_defaultParams;

		protected $_removeExtraSlashes;

		protected $_notFoundPaths;

		public function __construct($defaultRoutes=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function getRewriteUri(){ }


		public function setUriSource($uriSource){ }


		public function removeExtraSlashes($remove){ }


		public function setDefaultNamespace($namespaceName){ }


		public function setDefaultModule($moduleName){ }


		public function setDefaultController($controllerName){ }


		public function setDefaultAction($actionName){ }


		public function setDefaults($defaults){ }


		public function getDefaults(){ }


		public function handle($uri=null){ }


		public function add($pattern, $paths=null, $httpMethods=null, $position=null){ }


		public function addGet($pattern, $paths=null, $position=null){ }


		public function addPost($pattern, $paths=null, $position=null){ }


		public function addPut($pattern, $paths=null, $position=null){ }


		public function addPatch($pattern, $paths=null, $position=null){ }


		public function addDelete($pattern, $paths=null, $position=null){ }


		public function addOptions($pattern, $paths=null, $position=null){ }


		public function addHead($pattern, $paths=null, $position=null){ }


		public function addPurge($pattern, $paths=null, $position=null){ }


		public function addTrace($pattern, $paths=null, $position=null){ }


		public function addConnect($pattern, $paths=null, $position=null){ }


		public function mount(\Phalcon\Mvc\Router\GroupInterface $group){ }


		public function notFound($paths){ }


		public function clear(){ }


		public function getNamespaceName(){ }


		public function getModuleName(){ }


		public function getControllerName(){ }


		public function getActionName(){ }


		public function getParams(){ }


		public function getMatchedRoute(){ }


		public function getMatches(){ }


		public function wasMatched(){ }


		public function getRoutes(){ }


		public function getRouteById($id){ }


		public function getRouteByName($name){ }


		public function isExactControllerName(){ }

	}
}
