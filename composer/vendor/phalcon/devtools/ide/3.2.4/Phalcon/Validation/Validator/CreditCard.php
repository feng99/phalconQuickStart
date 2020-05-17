<?php 

namespace Phalcon\Validation\Validator {

	class CreditCard extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		public function validate(\Phalcon\Validation $validation, $field){ }


		private function verifyByLuhnAlgorithm($number){ }

	}
}
