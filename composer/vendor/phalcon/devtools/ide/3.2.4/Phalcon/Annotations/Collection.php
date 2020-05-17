<?php 

namespace Phalcon\Annotations {

	class Collection implements \Iterator, \Traversable, \Countable {

		protected $_position;

		protected $_annotations;

		public function __construct($reflectionData=null){ }


		public function count(){ }


		public function rewind(){ }


		public function current(){ }


		public function key(){ }


		public function next(){ }


		public function valid(){ }


		public function getAnnotations(){ }


		public function get($name){ }


		public function getAll($name){ }


		public function has($name){ }

	}
}
