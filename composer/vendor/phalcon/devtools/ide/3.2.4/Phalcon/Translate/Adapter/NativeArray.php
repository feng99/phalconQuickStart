<?php 

namespace Phalcon\Translate\Adapter {

	class NativeArray extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_translate;

		public function __construct($options){ }


		public function query($index, $placeholders=null){ }


		public function exists($index){ }

	}
}
