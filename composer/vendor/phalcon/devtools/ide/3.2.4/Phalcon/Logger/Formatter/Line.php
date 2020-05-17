<?php 

namespace Phalcon\Logger\Formatter {

	class Line extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_dateFormat;

		protected $_format;

		public function getDateFormat(){ }


		public function setDateFormat($dateFormat){ }


		public function getFormat(){ }


		public function setFormat($format){ }


		public function __construct($format=null, $dateFormat=null){ }


		public function format($message, $type, $timestamp, $context=null){ }

	}
}
