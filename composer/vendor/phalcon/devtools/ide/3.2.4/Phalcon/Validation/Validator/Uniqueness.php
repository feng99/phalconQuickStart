<?php 

namespace Phalcon\Validation\Validator {

	class Uniqueness extends \Phalcon\Validation\CombinedFieldsValidator implements \Phalcon\Validation\ValidatorInterface {

		private $columnMap;

		public function validate(\Phalcon\Validation $validation, $field){ }


		protected function isUniqueness(\Phalcon\Validation $validation, $field){ }


		protected function getColumnNameReal($record, $field){ }


		protected function isUniquenessModel($record, $field, $values){ }


		protected function isUniquenessCollection($record, $field, $values){ }

	}
}
