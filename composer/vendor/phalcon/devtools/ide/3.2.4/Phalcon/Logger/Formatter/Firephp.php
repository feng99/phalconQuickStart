<?php 

namespace Phalcon\Logger\Formatter {

	class Firephp extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_showBacktrace;

		protected $_enableLabels;

		public function getTypeString($type){ }


		public function setShowBacktrace($isShow=null){ }


		public function getShowBacktrace(){ }


		public function enableLabels($isEnable=null){ }


		public function labelsEnabled(){ }


		public function format($message, $type, $timestamp, $context=null){ }

	}
}
