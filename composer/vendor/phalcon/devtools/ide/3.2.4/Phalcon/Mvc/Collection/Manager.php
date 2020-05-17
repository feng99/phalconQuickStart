<?php 

namespace Phalcon\Mvc\Collection {

	class Manager implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_lastInitialized;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_connectionServices;

		protected $_implicitObjectsIds;

		protected $_behaviors;

		protected $_serviceName;

		public function getServiceName(){ }


		public function setServiceName($serviceName){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model){ }


		public function initialize(\Phalcon\Mvc\CollectionInterface $model){ }


		public function isInitialized($modelName){ }


		public function getLastInitialized(){ }


		public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService){ }


		public function getConnectionService(\Phalcon\Mvc\CollectionInterface $model){ }


		public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds){ }


		public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model){ }


		public function getConnection(\Phalcon\Mvc\CollectionInterface $model){ }


		public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model){ }


		public function missingMethod(\Phalcon\Mvc\CollectionInterface $model, $eventName, $data){ }


		public function addBehavior(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Mvc\Collection\BehaviorInterface $behavior){ }

	}
}
