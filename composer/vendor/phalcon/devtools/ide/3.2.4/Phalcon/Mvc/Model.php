<?php 

namespace Phalcon\Mvc {

	abstract class Model implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\ModelInterface, \Phalcon\Mvc\Model\ResultInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable, \JsonSerializable {

		const OP_NONE = 0;

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		const DIRTY_STATE_PERSISTENT = 0;

		const DIRTY_STATE_TRANSIENT = 1;

		const DIRTY_STATE_DETACHED = 2;

		protected $_dependencyInjector;

		protected $_modelsManager;

		protected $_modelsMetaData;

		protected $_errorMessages;

		protected $_operationMade;

		protected $_dirtyState;

		protected $_transaction;

		protected $_uniqueKey;

		protected $_uniqueParams;

		protected $_uniqueTypes;

		protected $_skipped;

		protected $_related;

		protected $_snapshot;

		protected $_oldSnapshot;

		final public function __construct($data=null, \Phalcon\DiInterface $dependencyInjector=null, \Phalcon\Mvc\Model\ManagerInterface $modelsManager=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		protected function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		protected function getEventsManager(){ }


		public function getModelsMetaData(){ }


		public function getModelsManager(){ }


		public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction){ }


		protected function setSource($source){ }


		public function getSource(){ }


		protected function setSchema($schema){ }


		public function getSchema(){ }


		public function setConnectionService($connectionService){ }


		public function setReadConnectionService($connectionService){ }


		public function setWriteConnectionService($connectionService){ }


		public function getReadConnectionService(){ }


		public function getWriteConnectionService(){ }


		public function setDirtyState($dirtyState){ }


		public function getDirtyState(){ }


		public function getReadConnection(){ }


		public function getWriteConnection(){ }


		public function assign($data, $dataColumnMap=null, $whiteList=null){ }


		public static function cloneResultMap($base, $data, $columnMap, $dirtyState=null, $keepSnapshots=null){ }


		public static function cloneResultMapHydrate($data, $columnMap, $hydrationMode){ }


		public static function cloneResult(\Phalcon\Mvc\ModelInterface $base, $data, $dirtyState=null){ }


		public static function find($parameters=null){ }


		public static function findFirst($parameters=null){ }


		public static function query(\Phalcon\DiInterface $dependencyInjector=null){ }


		protected function _exists(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table=null){ }


		protected static function _groupResult($functionName, $alias, $parameters){ }


		public static function count($parameters=null){ }


		public static function sum($parameters=null){ }


		public static function maximum($parameters=null){ }


		public static function minimum($parameters=null){ }


		public static function average($parameters=null){ }


		public function fireEvent($eventName){ }


		public function fireEventCancel($eventName){ }


		protected function _cancelOperation(){ }


		public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message){ }


		protected function validate(\Phalcon\ValidationInterface $validator){ }


		public function validationHasFailed(){ }


		public function getMessages($filter=null){ }


		final protected function _checkForeignKeysRestrict(){ }


		final protected function _checkForeignKeysReverseCascade(){ }


		final protected function _checkForeignKeysReverseRestrict(){ }


		protected function _preSave(\Phalcon\Mvc\Model\MetaDataInterface $metaData, $exists, $identityField){ }


		protected function _postSave($success, $exists){ }


		protected function _doLowInsert(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table, $identityField){ }


		protected function _doLowUpdate(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table){ }


		protected function _preSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related){ }


		protected function _postSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related){ }


		public function save($data=null, $whiteList=null){ }


		public function create($data=null, $whiteList=null){ }


		public function update($data=null, $whiteList=null){ }


		public function delete(){ }


		public function getOperationMade(){ }


		public function refresh(){ }


		public function skipOperation($skip){ }


		public function readAttribute($attribute){ }


		public function writeAttribute($attribute, $value){ }


		protected function skipAttributes($attributes){ }


		protected function skipAttributesOnCreate($attributes){ }


		protected function skipAttributesOnUpdate($attributes){ }


		protected function allowEmptyStringValues($attributes){ }


		protected function hasOne($fields, $referenceModel, $referencedFields, $options=null){ }


		protected function belongsTo($fields, $referenceModel, $referencedFields, $options=null){ }


		protected function hasMany($fields, $referenceModel, $referencedFields, $options=null){ }


		protected function hasManyToMany($fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referenceModel, $referencedFields, $options=null){ }


		public function addBehavior(\Phalcon\Mvc\Model\BehaviorInterface $behavior){ }


		protected function keepSnapshots($keepSnapshot){ }


		public function setSnapshotData($data, $columnMap=null){ }


		public function hasSnapshotData(){ }


		public function getSnapshotData(){ }


		public function getOldSnapshotData(){ }


		public function hasChanged($fieldName=null, $allFields=null){ }


		public function hasUpdated($fieldName=null, $allFields=null){ }


		public function getChangedFields(){ }


		public function getUpdatedFields(){ }


		protected function useDynamicUpdate($dynamicUpdate){ }


		public function getRelated($alias, $arguments=null){ }


		protected function _getRelatedRecords($modelName, $method, $arguments){ }


		final protected static function _invokeFinder($method, $arguments){ }


		public function __call($method, $arguments){ }


		public static function __callStatic($method, $arguments){ }


		public function __set($property, $value){ }


		final protected function _possibleSetter($property, $value){ }


		public function __get($property){ }


		public function __isset($property){ }


		public function serialize(){ }


		public function unserialize($data){ }


		public function dump(){ }


		public function toArray($columns=null){ }


		public function jsonSerialize(){ }


		public static function setup($options){ }


		public function reset(){ }

	}
}
