<?php 

namespace Phalcon\Mvc\Micro {

	class LazyLoader {

		protected $_handler;

		protected $_modelBinder;

		protected $_definition;

		public function getDefinition(){ }


		public function __construct($definition){ }


		public function __call($method, $arguments){ }


		public function callMethod($method, $arguments, \Phalcon\Mvc\Model\BinderInterface $modelBinder=null){ }

	}
}
