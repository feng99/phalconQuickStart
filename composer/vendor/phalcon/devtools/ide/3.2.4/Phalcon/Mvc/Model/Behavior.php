<?php 

namespace Phalcon\Mvc\Model {

	abstract class Behavior implements \Phalcon\Mvc\Model\BehaviorInterface {

		protected $_options;

		public function __construct($options=null){ }


		protected function mustTakeAction($eventName){ }


		protected function getOptions($eventName=null){ }


		public function notify($type, \Phalcon\Mvc\ModelInterface $model){ }


		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $method, $arguments=null){ }

	}
}
