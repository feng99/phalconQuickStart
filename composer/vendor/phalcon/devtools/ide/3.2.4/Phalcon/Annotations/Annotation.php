<?php 

namespace Phalcon\Annotations {

	class Annotation {

		protected $_name;

		protected $_arguments;

		protected $_exprArguments;

		public function __construct($reflectionData){ }


		public function getName(){ }


		public function getExpression($expr){ }


		public function getExprArguments(){ }


		public function getArguments(){ }


		public function numberArguments(){ }


		public function getArgument($position){ }


		public function hasArgument($position){ }


		public function getNamedArgument($name){ }


		public function getNamedParameter($name){ }

	}
}
