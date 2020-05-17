<?php 

namespace Phalcon\Debug {

	class Dump {

		protected $_detailed;

		protected $_methods;

		protected $_styles;

		public function getDetailed(){ }


		public function setDetailed($detailed){ }


		public function __construct($styles=null, $detailed=null){ }


		public function all(){ }


		protected function getStyle($type){ }


		public function setStyles($styles=null){ }


		public function one($variable, $name=null){ }


		protected function output($variable, $name=null, $tab=null){ }


		public function variable($variable, $name=null){ }


		public function variables(){ }


		public function toJson($variable){ }

	}
}
