<?php 

namespace Phalcon\Cache\Frontend {

	class Msgpack extends \Phalcon\Cache\Frontend\Data implements \Phalcon\Cache\FrontendInterface {

		public function __construct($frontendOptions=null){ }


		public function getLifetime(){ }


		public function isBuffering(){ }


		public function start(){ }


		public function getContent(){ }


		public function stop(){ }


		public function beforeStore($data){ }


		public function afterRetrieve($data){ }

	}
}
