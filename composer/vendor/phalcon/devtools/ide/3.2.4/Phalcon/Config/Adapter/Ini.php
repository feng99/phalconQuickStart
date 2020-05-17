<?php 

namespace Phalcon\Config\Adapter {

	class Ini extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		public function __construct($filePath, $mode=null){ }


		protected function _parseIniString($path, $value){ }


		protected function _cast($ini){ }

	}
}
