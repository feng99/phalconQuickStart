<?php 

namespace Phalcon\Mvc\Model\MetaData\Strategy {

	class Annotations implements \Phalcon\Mvc\Model\MetaData\StrategyInterface {

		final public function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector){ }


		final public function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector){ }

	}
}
