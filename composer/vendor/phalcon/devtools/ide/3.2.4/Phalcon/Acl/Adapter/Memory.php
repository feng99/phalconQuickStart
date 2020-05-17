<?php 

namespace Phalcon\Acl\Adapter {

	class Memory extends \Phalcon\Acl\Adapter implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Acl\AdapterInterface {

		protected $_rolesNames;

		protected $_roles;

		protected $_resourcesNames;

		protected $_resources;

		protected $_access;

		protected $_roleInherits;

		protected $_accessList;

		protected $_func;

		protected $_noArgumentsDefaultAction;

		public function __construct(){ }


		public function addRole($role, $accessInherits=null){ }


		public function addInherit($roleName, $roleToInherit){ }


		public function isRole($roleName){ }


		public function isResource($resourceName){ }


		public function addResource($resourceValue, $accessList){ }


		public function addResourceAccess($resourceName, $accessList){ }


		public function dropResourceAccess($resourceName, $accessList){ }


		protected function _allowOrDeny($roleName, $resourceName, $access, $action, $func=null){ }


		public function allow($roleName, $resourceName, $access, $func=null){ }


		public function deny($roleName, $resourceName, $access, $func=null){ }


		public function isAllowed($roleName, $resourceName, $access, $parameters=null){ }


		public function setNoArgumentsDefaultAction($defaultAccess){ }


		public function getNoArgumentsDefaultAction(){ }


		public function getRoles(){ }


		public function getResources(){ }

	}
}
