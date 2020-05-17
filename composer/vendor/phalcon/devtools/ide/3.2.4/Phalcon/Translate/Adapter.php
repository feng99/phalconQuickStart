<?php 

namespace Phalcon\Translate {

	abstract class Adapter implements \Phalcon\Translate\AdapterInterface {

		protected $_interpolator;

		public function __construct($options){ }


		public function setInterpolator(\Phalcon\Translate\InterpolatorInterface $interpolator){ }


		public function t($translateKey, $placeholders=null){ }


		public function _($translateKey, $placeholders=null){ }


		public function offsetSet($offset, $value){ }


		public function offsetExists($translateKey){ }


		public function offsetUnset($offset){ }


		public function offsetGet($translateKey){ }


		protected function replacePlaceholders($translation, $placeholders=null){ }

	}
}
