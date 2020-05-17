<?php 

namespace Phalcon\Security {

	class Random {

		public function bytes($len=null){ }


		public function hex($len=null){ }


		public function base58($len=null){ }


		public function base62($len=null){ }


		public function base64($len=null){ }


		public function base64Safe($len=null, $padding=null){ }


		public function uuid(){ }


		public function number($len){ }


		protected function base($alphabet, $base, $n=null){ }

	}
}
