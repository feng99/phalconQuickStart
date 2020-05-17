<?php 

namespace Phalcon\Config\Adapter {

	class Json extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		public function __construct($filePath){ }

	}
}
