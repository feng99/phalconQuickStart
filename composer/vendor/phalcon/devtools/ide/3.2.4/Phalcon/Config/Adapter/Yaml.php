<?php 

namespace Phalcon\Config\Adapter {

	class Yaml extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		public function __construct($filePath, $callbacks=null){ }

	}
}
