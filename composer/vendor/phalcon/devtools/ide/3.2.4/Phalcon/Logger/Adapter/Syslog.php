<?php 

namespace Phalcon\Logger\Adapter {

	class Syslog extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_opened;

		public function __construct($name, $options=null){ }


		public function getFormatter(){ }


		public function logInternal($message, $type, $time, $context){ }


		public function close(){ }

	}
}
