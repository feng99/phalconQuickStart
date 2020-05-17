<?php 

namespace Phalcon\Db\Profiler {

	class Item {

		protected $_sqlStatement;

		protected $_sqlVariables;

		protected $_sqlBindTypes;

		protected $_initialTime;

		protected $_finalTime;

		public function setSqlStatement($sqlStatement){ }


		public function getSqlStatement(){ }


		public function setSqlVariables($sqlVariables){ }


		public function getSqlVariables(){ }


		public function setSqlBindTypes($sqlBindTypes){ }


		public function getSqlBindTypes(){ }


		public function setInitialTime($initialTime){ }


		public function getInitialTime(){ }


		public function setFinalTime($finalTime){ }


		public function getFinalTime(){ }


		public function getTotalElapsedSeconds(){ }

	}
}
