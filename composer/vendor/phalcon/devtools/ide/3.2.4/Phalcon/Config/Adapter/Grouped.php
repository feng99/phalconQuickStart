<?php 

namespace Phalcon\Config\Adapter {

	class Grouped extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		public function __construct($arrayConfig, $defaultAdapter=null){ }

	}
}
