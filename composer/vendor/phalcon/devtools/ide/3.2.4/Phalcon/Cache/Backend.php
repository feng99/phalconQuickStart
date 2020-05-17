<?php 

namespace Phalcon\Cache {

	abstract class Backend implements \Phalcon\Cache\BackendInterface {

		protected $_frontend;

		protected $_options;

		protected $_prefix;

		protected $_lastKey;

		protected $_lastLifetime;

		protected $_fresh;

		protected $_started;

		public function getFrontend(){ }


		public function setFrontend($frontend){ }


		public function getOptions(){ }


		public function setOptions($options){ }


		public function getLastKey(){ }


		public function setLastKey($lastKey){ }


		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		public function start($keyName, $lifetime=null){ }


		public function stop($stopBuffer=null){ }


		public function isFresh(){ }


		public function isStarted(){ }


		public function getLifetime(){ }

	}
}
