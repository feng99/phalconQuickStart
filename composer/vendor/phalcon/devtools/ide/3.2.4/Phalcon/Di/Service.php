<?php 

namespace Phalcon\Di {

	class Service implements \Phalcon\Di\ServiceInterface {

		protected $_name;

		protected $_definition;

		protected $_shared;

		protected $_resolved;

		protected $_sharedInstance;

		final public function __construct($name, $definition, $shared=null){ }


		public function getName(){ }


		public function setShared($shared){ }


		public function isShared(){ }


		public function setSharedInstance($sharedInstance){ }


		public function setDefinition($definition){ }


		public function getDefinition(){ }


		public function resolve($parameters=null, \Phalcon\DiInterface $dependencyInjector=null){ }


		public function setParameter($position, $parameter){ }


		public function getParameter($position){ }


		public function isResolved(){ }


		public static function __set_state($attributes){ }

	}
}
