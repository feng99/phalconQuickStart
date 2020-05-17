<?php 

namespace Phalcon\Mvc\Model {

	class Row implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\Model\ResultInterface, \ArrayAccess, \JsonSerializable {

		public function setDirtyState($dirtyState){ }


		public function offsetExists($index){ }


		public function offsetGet($index){ }


		public function offsetSet($index, $value){ }


		public function offsetUnset($offset){ }


		public function readAttribute($attribute){ }


		public function writeAttribute($attribute, $value){ }


		public function toArray(){ }


		public function jsonSerialize(){ }

	}
}
