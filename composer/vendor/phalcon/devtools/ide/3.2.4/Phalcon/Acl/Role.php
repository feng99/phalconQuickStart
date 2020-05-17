<?php 

namespace Phalcon\Acl {

	class Role implements \Phalcon\Acl\RoleInterface {

		protected $_name;

		protected $_description;

		public function getName(){ }


		public function __toString(){ }


		public function getDescription(){ }


		public function __construct($name, $description=null){ }

	}
}
