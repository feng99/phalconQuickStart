<?php 

namespace Phalcon\Logger {

	abstract class Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_transaction;

		protected $_queue;

		protected $_formatter;

		protected $_logLevel;

		public function setLogLevel($level){ }


		public function getLogLevel(){ }


		public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter){ }


		public function begin(){ }


		public function commit(){ }


		public function rollback(){ }


		public function isTransaction(){ }


		public function critical($message, $context=null){ }


		public function emergency($message, $context=null){ }


		public function debug($message, $context=null){ }


		public function error($message, $context=null){ }


		public function info($message, $context=null){ }


		public function notice($message, $context=null){ }


		public function warning($message, $context=null){ }


		public function alert($message, $context=null){ }


		public function log($type, $message=null, $context=null){ }

	}
}
