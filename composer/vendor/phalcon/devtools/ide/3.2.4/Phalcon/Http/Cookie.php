<?php 

namespace Phalcon\Http {

	class Cookie implements \Phalcon\Http\CookieInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_readed;

		protected $_restored;

		protected $_useEncryption;

		protected $_dependencyInjector;

		protected $_filter;

		protected $_name;

		protected $_value;

		protected $_expire;

		protected $_path;

		protected $_domain;

		protected $_secure;

		protected $_httpOnly;

		public function __construct($name, $value=null, $expire=null, $path=null, $secure=null, $domain=null, $httpOnly=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setValue($value){ }


		public function getValue($filters=null, $defaultValue=null){ }


		public function send(){ }


		public function restore(){ }


		public function delete(){ }


		public function useEncryption($useEncryption){ }


		public function isUsingEncryption(){ }


		public function setExpiration($expire){ }


		public function getExpiration(){ }


		public function setPath($path){ }


		public function getName(){ }


		public function getPath(){ }


		public function setDomain($domain){ }


		public function getDomain(){ }


		public function setSecure($secure){ }


		public function getSecure(){ }


		public function setHttpOnly($httpOnly){ }


		public function getHttpOnly(){ }


		public function __toString(){ }

	}
}
