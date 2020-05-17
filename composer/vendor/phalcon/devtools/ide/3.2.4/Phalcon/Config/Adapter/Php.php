<?php 

namespace Phalcon\Config\Adapter {

	class Php extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		public function __construct($filePath){ }

	}
}
