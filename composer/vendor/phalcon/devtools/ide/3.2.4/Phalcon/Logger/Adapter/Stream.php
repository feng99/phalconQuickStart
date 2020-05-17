<?php 

namespace Phalcon\Logger\Adapter {

	class Stream extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_stream;

		public function __construct($name, $options=null){ }


		public function getFormatter(){ }


		public function logInternal($message, $type, $time, $context){ }


		public function close(){ }

	}
}
