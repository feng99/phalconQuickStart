<?php 

namespace Phalcon\Logger\Adapter {

	class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		private $_initialized;

		private $_index;

		public function getFormatter(){ }


		public function logInternal($message, $type, $time, $context){ }


		public function close(){ }

	}
}
