<?php 

namespace Phalcon\Mvc\Model\Validator {

	class Ip extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		const VERSION_4 = 1048576;

		const VERSION_6 = 2097152;

		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
