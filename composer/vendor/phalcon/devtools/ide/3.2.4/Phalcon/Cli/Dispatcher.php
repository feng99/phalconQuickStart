<?php 

namespace Phalcon\Cli {

	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\DispatcherInterface, \Phalcon\Cli\DispatcherInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_handlerSuffix;

		protected $_defaultHandler;

		protected $_defaultAction;

		protected $_options;

		public function setTaskSuffix($taskSuffix){ }


		public function setDefaultTask($taskName){ }


		public function setTaskName($taskName){ }


		public function getTaskName(){ }


		protected function _throwDispatchException($message, $exceptionCode=null){ }


		protected function _handleException(\Exception $exception){ }


		public function getLastTask(){ }


		public function getActiveTask(){ }


		public function setOptions($options){ }


		public function getOptions(){ }


		public function getOption($option, $filters=null, $defaultValue=null){ }


		public function hasOption($option){ }


		public function callActionMethod($handler, $actionMethod, $params=null){ }

	}
}
