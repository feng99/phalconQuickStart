<?php 

namespace Phalcon\Cli\Router {

	class Route {

		const DEFAULT_DELIMITER =  ;

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_converters;

		protected $_id;

		protected $_name;

		protected $_beforeMatch;

		protected $_delimiter;

		protected static $_uniqueId;

		protected static $_delimiterPath;

		public function __construct($pattern, $paths=null){ }


		public function compilePattern($pattern){ }


		public function extractNamedParams($pattern){ }


		public function reConfigure($pattern, $paths=null){ }


		public function getName(){ }


		public function setName($name){ }


		public function beforeMatch($callback){ }


		public function getBeforeMatch(){ }


		public function getRouteId(){ }


		public function getPattern(){ }


		public function getCompiledPattern(){ }


		public function getPaths(){ }


		public function getReversedPaths(){ }


		public function convert($name, $converter){ }


		public function getConverters(){ }


		public static function reset(){ }


		public static function delimiter($delimiter=null){ }


		public static function getDelimiter(){ }

	}
}
