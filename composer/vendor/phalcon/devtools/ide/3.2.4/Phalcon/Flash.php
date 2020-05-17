<?php 

namespace Phalcon {

	abstract class Flash implements \Phalcon\FlashInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_cssClasses;

		protected $_implicitFlush;

		protected $_automaticHtml;

		protected $_escaperService;

		protected $_autoescape;

		protected $_dependencyInjector;

		protected $_messages;

		public function __construct($cssClasses=null){ }


		public function getAutoescape(){ }


		public function setAutoescape($autoescape){ }


		public function getEscaperService(){ }


		public function setEscaperService(\Phalcon\EscaperInterface $escaperService){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setImplicitFlush($implicitFlush){ }


		public function setAutomaticHtml($automaticHtml){ }


		public function setCssClasses($cssClasses){ }


		public function error($message){ }


		public function notice($message){ }


		public function success($message){ }


		public function warning($message){ }


		public function outputMessage($type, $message){ }


		public function clear(){ }

	}
}
