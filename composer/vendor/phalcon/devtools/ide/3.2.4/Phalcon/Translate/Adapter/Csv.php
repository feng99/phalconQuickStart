<?php 

namespace Phalcon\Translate\Adapter {

	class Csv extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_translate;

		public function __construct($options){ }


		private function _load($file, $length, $delimiter, $enclosure){ }


		public function query($index, $placeholders=null){ }


		public function exists($index){ }

	}
}
