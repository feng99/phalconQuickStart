<?php 

namespace Phalcon\Annotations\Adapter {

	class Memory extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_data;

		public function read($key){ }


		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
