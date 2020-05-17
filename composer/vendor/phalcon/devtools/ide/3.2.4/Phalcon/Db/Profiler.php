<?php 

namespace Phalcon\Db {

	class Profiler {

		protected $_allProfiles;

		protected $_activeProfile;

		protected $_totalSeconds;

		public function startProfile($sqlStatement, $sqlVariables=null, $sqlBindTypes=null){ }


		public function stopProfile(){ }


		public function getNumberTotalStatements(){ }


		public function getTotalElapsedSeconds(){ }


		public function getProfiles(){ }


		public function reset(){ }


		public function getLastProfile(){ }

	}
}
