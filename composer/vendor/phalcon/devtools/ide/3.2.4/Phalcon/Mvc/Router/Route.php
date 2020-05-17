<?php 

namespace Phalcon\Mvc\Router {

	class Route implements \Phalcon\Mvc\Router\RouteInterface {

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_methods;

		protected $_hostname;

		protected $_converters;

		protected $_id;

		protected $_name;

		protected $_beforeMatch;

		protected $_match;

		protected $_group;

		protected static $_uniqueId;

		public function __construct($pattern, $paths=null, $httpMethods=null){ }


		public function compilePattern($pattern){ }


		public function via($httpMethods){ }


		public function extractNamedParams($pattern){ }


		public function reConfigure($pattern, $paths=null){ }


		public static function getRoutePaths($paths=null){ }


		public function getName(){ }


		public function setName($name){ }


		public function beforeMatch($callback){ }


		public function getBeforeMatch(){ }


		public function match($callback){ }


		public function getMatch(){ }


		public function getRouteId(){ }


		public function getPattern(){ }


		public function getCompiledPattern(){ }


		public function getPaths(){ }


		public function getReversedPaths(){ }


		public function setHttpMethods($httpMethods){ }


		public function getHttpMethods(){ }


		public function setHostname($hostname){ }


		public function getHostname(){ }


		public function setGroup(\Phalcon\Mvc\Router\GroupInterface $group){ }


		public function getGroup(){ }


		public function convert($name, $converter){ }


		public function getConverters(){ }


		public static function reset(){ }

	}
}
