<?php 

namespace Phalcon\Mvc\View\Engine {

	class Volt extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_options;

		protected $_compiler;

		protected $_macros;

		public function setOptions($options){ }


		public function getOptions(){ }


		public function getCompiler(){ }


		public function render($templatePath, $params, $mustClean=null){ }


		public function length($item){ }


		public function isIncluded($needle, $haystack){ }


		public function convertEncoding($text, $from, $to){ }


		public function slice($value, $start=null, $end=null){ }


		public function sort($value){ }


		public function callMacro($name, $arguments=null){ }

	}
}
