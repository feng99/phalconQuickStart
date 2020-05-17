<?php 

namespace Phalcon\Logger {

	class Multiple {

		protected $_loggers;

		protected $_formatter;

		protected $_logLevel;

		public function getLoggers(){ }


		public function getFormatter(){ }


		public function getLogLevel(){ }


		public function push(\Phalcon\Logger\AdapterInterface $logger){ }


		public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter){ }


		public function setLogLevel($level){ }


		public function log($type, $message=null, $context=null){ }


		public function critical($message, $context=null){ }


		public function emergency($message, $context=null){ }


		public function debug($message, $context=null){ }


		public function error($message, $context=null){ }


		public function info($message, $context=null){ }


		public function notice($message, $context=null){ }


		public function warning($message, $context=null){ }


		public function alert($message, $context=null){ }

	}
}
