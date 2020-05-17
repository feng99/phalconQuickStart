<?php 

namespace Phalcon\Logger {

	abstract class Formatter implements \Phalcon\Logger\FormatterInterface {

		public function getTypeString($type){ }


		public function interpolate($message, $context=null){ }

	}
}
