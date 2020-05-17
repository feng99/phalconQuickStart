<?php 

namespace Phalcon {

	class Config implements \ArrayAccess, \Countable {

		const DEFAULT_PATH_DELIMITER = .;

		protected static $_pathDelimiter;

		public function __construct($arrayConfig=null){ }


		public function offsetExists($index){ }


		public function path($path, $defaultValue=null, $delimiter=null){ }


		public function get($index, $defaultValue=null){ }


		public function offsetGet($index){ }


		public function offsetSet($index, $value){ }


		public function offsetUnset($index){ }


		public function merge(\Phalcon\Config $config){ }


		public function toArray(){ }


		public function count(){ }


		public static function __set_state($data){ }


		public static function setPathDelimiter($delimiter=null){ }


		public static function getPathDelimiter(){ }


		final protected function _merge(\Phalcon\Config $config, $instance=null){ }

	}
}
