<?php 

namespace Phalcon\Logger\Adapter {

	class File extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_fileHandler;

		protected $_path;

		protected $_options;

		public function getPath(){ }


		public function __construct($name, $options=null){ }


		public function getFormatter(){ }


		public function logInternal($message, $type, $time, $context){ }


		public function close(){ }


		public function __wakeup(){ }

	}
}
