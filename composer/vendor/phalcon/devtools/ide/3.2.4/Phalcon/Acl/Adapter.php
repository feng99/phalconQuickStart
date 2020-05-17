<?php 

namespace Phalcon\Acl {

	abstract class Adapter implements \Phalcon\Acl\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_defaultAccess;

		protected $_accessGranted;

		protected $_activeRole;

		protected $_activeResource;

		protected $_activeAccess;

		public function getActiveRole(){ }


		public function getActiveResource(){ }


		public function getActiveAccess(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setDefaultAction($defaultAccess){ }


		public function getDefaultAction(){ }

	}
}
