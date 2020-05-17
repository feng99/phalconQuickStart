<?php 

namespace Phalcon\Annotations {

	abstract class Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_reader;

		protected $_annotations;

		public function setReader(\Phalcon\Annotations\ReaderInterface $reader){ }


		public function getReader(){ }


		public function get($className){ }


		public function getMethods($className){ }


		public function getMethod($className, $methodName){ }


		public function getProperties($className){ }


		public function getProperty($className, $propertyName){ }

	}
}
