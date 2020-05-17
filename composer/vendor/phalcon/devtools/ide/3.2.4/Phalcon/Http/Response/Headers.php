<?php 

namespace Phalcon\Http\Response {

	class Headers implements \Phalcon\Http\Response\HeadersInterface {

		protected $_headers;

		public function set($name, $value){ }


		public function get($name){ }


		public function setRaw($header){ }


		public function remove($header){ }


		public function send(){ }


		public function reset(){ }


		public function toArray(){ }


		public static function __set_state($data){ }

	}
}
