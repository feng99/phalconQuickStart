<?php 

namespace Phalcon\Annotations\Adapter {

	class Files extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_annotationsDir;

		public function __construct($options=null){ }


		public function read($key){ }


		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
