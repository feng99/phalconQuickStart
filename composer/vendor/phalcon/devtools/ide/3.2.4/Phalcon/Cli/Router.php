<?php 

namespace Phalcon\Cli {

	class Router implements \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_module;

		protected $_task;

		protected $_action;

		protected $_params;

		protected $_defaultModule;

		protected $_defaultTask;

		protected $_defaultAction;

		protected $_defaultParams;

		protected $_routes;

		protected $_matchedRoute;

		protected $_matches;

		protected $_wasMatched;

		public function __construct($defaultRoutes=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setDefaultModule($moduleName){ }


		public function setDefaultTask($taskName){ }


		public function setDefaultAction($actionName){ }


		public function setDefaults($defaults){ }


		public function handle($arguments=null){ }


		public function add($pattern, $paths=null){ }


		public function getModuleName(){ }


		public function getTaskName(){ }


		public function getActionName(){ }


		public function getParams(){ }


		public function getMatchedRoute(){ }


		public function getMatches(){ }


		public function wasMatched(){ }


		public function getRoutes(){ }


		public function getRouteById($id){ }


		public function getRouteByName($name){ }

	}
}
