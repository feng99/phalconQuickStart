<?php 

namespace Phalcon {

	class Debug {

		public $_uri;

		public $_theme;

		protected $_hideDocumentRoot;

		protected $_showBackTrace;

		protected $_showFiles;

		protected $_showFileFragment;

		protected $_data;

		protected static $_isActive;

		public function setUri($uri){ }


		public function setShowBackTrace($showBackTrace){ }


		public function setShowFiles($showFiles){ }


		public function setShowFileFragment($showFileFragment){ }


		public function listen($exceptions=null, $lowSeverity=null){ }


		public function listenExceptions(){ }


		public function listenLowSeverity(){ }


		public function halt(){ }


		public function debugVar($varz, $key=null){ }


		public function clearVars(){ }


		protected function _escapeString($value){ }


		protected function _getArrayDump($argument, $n=null){ }


		protected function _getVarDump($variable){ }


		public function getMajorVersion(){ }


		public function getVersion(){ }


		public function getCssSources(){ }


		public function getJsSources(){ }


		final protected function showTraceItem($n, $trace){ }


		public function onUncaughtLowSeverity($severity, $message, $file, $line, $context){ }


		public function onUncaughtException(\Exception $exception){ }

	}
}
