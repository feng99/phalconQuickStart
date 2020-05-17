<?php 

namespace Phalcon\Mvc\View {

	abstract class Engine extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\View\EngineInterface {

		protected $_view;

		public function __construct(\Phalcon\Mvc\ViewBaseInterface $view, \Phalcon\DiInterface $dependencyInjector=null){ }


		public function getContent(){ }


		public function partial($partialPath, $params=null){ }


		public function getView(){ }

	}
}
