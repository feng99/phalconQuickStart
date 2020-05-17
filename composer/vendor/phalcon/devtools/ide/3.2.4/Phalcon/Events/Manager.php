<?php 

namespace Phalcon\Events {

	class Manager implements \Phalcon\Events\ManagerInterface {

		protected $_events;

		protected $_collect;

		protected $_enablePriorities;

		protected $_responses;

		public function attach($eventType, $handler, $priority=null){ }


		public function detach($eventType, $handler){ }


		public function enablePriorities($enablePriorities){ }


		public function arePrioritiesEnabled(){ }


		public function collectResponses($collect){ }


		public function isCollecting(){ }


		public function getResponses(){ }


		public function detachAll($type=null){ }


		final public function fireQueue($queue, \Phalcon\Events\EventInterface $event){ }


		public function fire($eventType, $source, $data=null, $cancelable=null){ }


		public function hasListeners($type){ }


		public function getListeners($type){ }

	}
}
