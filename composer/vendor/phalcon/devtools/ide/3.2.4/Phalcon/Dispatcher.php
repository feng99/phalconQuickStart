<?php 

namespace Phalcon {

	abstract class Dispatcher implements \Phalcon\DispatcherInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_activeHandler;

		protected $_finished;

		protected $_forwarded;

		protected $_moduleName;

		protected $_namespaceName;

		protected $_handlerName;

		protected $_actionName;

		protected $_params;

		protected $_returnedValue;

		protected $_lastHandler;

		protected $_defaultNamespace;

		protected $_defaultHandler;

		protected $_defaultAction;

		protected $_handlerSuffix;

		protected $_actionSuffix;

		protected $_previousNamespaceName;

		protected $_previousHandlerName;

		protected $_previousActionName;

		protected $_modelBinding;

		protected $_modelBinder;

		protected $_isControllerInitialize;

		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setActionSuffix($actionSuffix){ }


		public function getActionSuffix(){ }


		public function setModuleName($moduleName){ }


		public function getModuleName(){ }


		public function setNamespaceName($namespaceName){ }


		public function getNamespaceName(){ }


		public function setDefaultNamespace($namespaceName){ }


		public function getDefaultNamespace(){ }


		public function setDefaultAction($actionName){ }


		public function setActionName($actionName){ }


		public function getActionName(){ }


		public function setParams($params){ }


		public function getParams(){ }


		public function setParam($param, $value){ }


		public function getParam($param, $filters=null, $defaultValue=null){ }


		public function hasParam($param){ }


		public function getActiveMethod(){ }


		public function isFinished(){ }


		public function setReturnedValue($value){ }


		public function getReturnedValue(){ }


		public function setModelBinding($value, $cache=null){ }


		public function setModelBinder(\Phalcon\Mvc\Model\BinderInterface $modelBinder, $cache=null){ }


		public function getModelBinder(){ }


		public function dispatch(){ }


		public function forward($forward){ }


		public function wasForwarded(){ }


		public function getHandlerClass(){ }


		public function callActionMethod($handler, $actionMethod, $params=null){ }


		public function getBoundModels(){ }


		protected function _resolveEmptyProperties(){ }

	}
}
