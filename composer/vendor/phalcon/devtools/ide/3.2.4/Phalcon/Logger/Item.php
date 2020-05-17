<?php 

namespace Phalcon\Logger {

	class Item {

		protected $_type;

		protected $_message;

		protected $_time;

		protected $_context;

		public function getType(){ }


		public function getMessage(){ }


		public function getTime(){ }


		public function getContext(){ }


		public function __construct($message, $type, $time=null, $context=null){ }

	}
}
