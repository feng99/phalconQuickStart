<?php 

namespace Phalcon\Tag {

	abstract class Select {

		public static function selectField($parameters, $data=null){ }


		private static function _optionsFromResultset($resultset, $using, $value, $closeOption){ }


		private static function _optionsFromArray($data, $value, $closeOption){ }

	}
}
