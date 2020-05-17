<?php 

namespace Phalcon\Acl {

	class Resource implements \Phalcon\Acl\ResourceInterface {

		protected $_name;

		protected $_description;

		public function getName(){ }


		public function __toString(){ }


		public function getDescription(){ }


		public function __construct($name, $description=null){ }

	}
}
