<?php 

namespace Phalcon\Annotations\Adapter {

	class Apcu extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_prefix;

		protected $_ttl;

		public function __construct($options=null){ }


		public function read($key){ }


		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
