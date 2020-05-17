<?php 

namespace Phalcon\Events {

	class Event implements \Phalcon\Events\EventInterface {

		protected $_type;

		protected $_source;

		protected $_data;

		protected $_stopped;

		protected $_cancelable;

		public function getType(){ }


		public function getSource(){ }


		public function getData(){ }


		public function __construct($type, $source, $data=null, $cancelable=null){ }


		public function setData($data=null){ }


		public function setType($type){ }


		public function stop(){ }


		public function isStopped(){ }


		public function isCancelable(){ }

	}
}
