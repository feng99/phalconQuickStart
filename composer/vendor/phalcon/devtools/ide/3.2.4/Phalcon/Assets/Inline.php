<?php 

namespace Phalcon\Assets {

	class Inline implements \Phalcon\Assets\ResourceInterface {

		protected $_type;

		protected $_content;

		protected $_filter;

		protected $_attributes;

		public function getType(){ }


		public function getContent(){ }


		public function getFilter(){ }


		public function getAttributes(){ }


		public function __construct($type, $content, $filter=null, $attributes=null){ }


		public function setType($type){ }


		public function setFilter($filter){ }


		public function setAttributes($attributes){ }


		public function getResourceKey(){ }

	}
}
