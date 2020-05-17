<?php 

namespace Phalcon\Mvc\Collection {

	abstract class Behavior implements \Phalcon\Mvc\Collection\BehaviorInterface {

		protected $_options;

		public function __construct($options=null){ }


		protected function mustTakeAction($eventName){ }


		protected function getOptions($eventName=null){ }


		public function notify($type, \Phalcon\Mvc\CollectionInterface $model){ }


		public function missingMethod(\Phalcon\Mvc\CollectionInterface $model, $method, $arguments=null){ }

	}
}
