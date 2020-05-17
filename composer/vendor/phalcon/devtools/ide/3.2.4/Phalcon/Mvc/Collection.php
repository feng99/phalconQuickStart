<?php 

namespace Phalcon\Mvc {

	abstract class Collection implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\CollectionInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable {

		const OP_NONE = 0;

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		const DIRTY_STATE_PERSISTENT = 0;

		const DIRTY_STATE_TRANSIENT = 1;

		const DIRTY_STATE_DETACHED = 2;

		public $_id;

		protected $_dependencyInjector;

		protected $_modelsManager;

		protected $_source;

		protected $_operationMade;

		protected $_dirtyState;

		protected $_connection;

		protected $_errorMessages;

		protected static $_reserved;

		protected static $_disableEvents;

		protected $_skipped;

		final public function __construct(\Phalcon\DiInterface $dependencyInjector=null, \Phalcon\Mvc\Collection\ManagerInterface $modelsManager=null){ }


		public function setId($id){ }


		public function getId(){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		protected function setEventsManager(\Phalcon\Mvc\Collection\ManagerInterface $eventsManager){ }


		protected function getEventsManager(){ }


		public function getCollectionManager(){ }


		public function getReservedAttributes(){ }


		protected function useImplicitObjectIds($useImplicitObjectIds){ }


		protected function setSource($source){ }


		public function getSource(){ }


		public function setConnectionService($connectionService){ }


		public function getConnectionService(){ }


		public function getConnection(){ }


		public function readAttribute($attribute){ }


		public function writeAttribute($attribute, $value){ }


		public static function cloneResult(\Phalcon\Mvc\CollectionInterface $collection, $document){ }


		protected static function _getResultset($params, \Phalcon\Mvc\CollectionInterface $collection, $connection, $unique){ }


		protected static function _getGroupResultset($params, \Phalcon\Mvc\Collection $collection, $connection){ }


		final protected function _preSave($dependencyInjector, $disableEvents, $exists){ }


		final protected function _postSave($disableEvents, $success, $exists){ }


		protected function validate($validator){ }


		public function validationHasFailed(){ }


		public function fireEvent($eventName){ }


		public function fireEventCancel($eventName){ }


		protected function _cancelOperation($disableEvents){ }


		protected function _exists($collection){ }


		public function getMessages(){ }


		public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message){ }


		protected function prepareCU(){ }


		public function save(){ }


		public function create(){ }


		public function createIfNotExist($criteria){ }


		public function update(){ }


		public static function findById($id){ }


		public static function findFirst($parameters=null){ }


		public static function find($parameters=null){ }


		public static function count($parameters=null){ }


		public static function aggregate($parameters=null){ }


		public static function summatory($field, $conditions=null, $finalize=null){ }


		public function delete(){ }


		public function setDirtyState($dirtyState){ }


		public function getDirtyState(){ }


		protected function addBehavior(\Phalcon\Mvc\Collection\BehaviorInterface $behavior){ }


		public function skipOperation($skip){ }


		public function toArray(){ }


		public function serialize(){ }


		public function unserialize($data){ }

	}
}
