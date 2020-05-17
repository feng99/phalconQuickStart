<?php 

namespace Phalcon\Mvc {

	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\DispatcherInterface, \Phalcon\Mvc\DispatcherInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_handlerSuffix;

		protected $_defaultHandler;

		protected $_defaultAction;

		public function setControllerSuffix($controllerSuffix){ }


		public function setDefaultController($controllerName){ }


		public function setControllerName($controllerName){ }


		public function getControllerName(){ }


		public function getPreviousNamespaceName(){ }


		public function getPreviousControllerName(){ }


		public function getPreviousActionName(){ }


		protected function _throwDispatchException($message, $exceptionCode=null){ }


		protected function _handleException(\Exception $exception){ }


		public function forward($forward){ }


		public function getControllerClass(){ }


		public function getLastController(){ }


		public function getActiveController(){ }

	}
}
