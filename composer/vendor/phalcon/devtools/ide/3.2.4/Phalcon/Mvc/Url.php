<?php 

namespace Phalcon\Mvc {

	class Url implements \Phalcon\Mvc\UrlInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_baseUri;

		protected $_staticBaseUri;

		protected $_basePath;

		protected $_router;

		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setBaseUri($baseUri){ }


		public function setStaticBaseUri($staticBaseUri){ }


		public function getBaseUri(){ }


		public function getStaticBaseUri(){ }


		public function setBasePath($basePath){ }


		public function getBasePath(){ }


		public function get($uri=null, $args=null, $local=null, $baseUri=null){ }


		public function getStatic($uri=null){ }


		public function path($path=null){ }

	}
}
