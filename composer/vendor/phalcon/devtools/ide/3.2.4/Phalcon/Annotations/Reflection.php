<?php 

namespace Phalcon\Annotations {

	class Reflection {

		protected $_reflectionData;

		protected $_classAnnotations;

		protected $_methodAnnotations;

		protected $_propertyAnnotations;

		public function __construct($reflectionData=null){ }


		public function getClassAnnotations(){ }


		public function getMethodsAnnotations(){ }


		public function getPropertiesAnnotations(){ }


		public function getReflectionData(){ }


		public static function __set_state($data){ }

	}
}
