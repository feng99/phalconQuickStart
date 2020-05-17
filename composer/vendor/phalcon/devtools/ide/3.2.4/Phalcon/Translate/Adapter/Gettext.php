<?php 

namespace Phalcon\Translate\Adapter {

	class Gettext extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_directory;

		protected $_defaultDomain;

		protected $_locale;

		protected $_category;

		public function getDirectory(){ }


		public function getDefaultDomain(){ }


		public function getLocale(){ }


		public function getCategory(){ }


		public function __construct($options){ }


		public function query($index, $placeholders=null){ }


		public function exists($index){ }


		public function nquery($msgid1, $msgid2, $count, $placeholders=null, $domain=null){ }


		public function setDomain($domain){ }


		public function resetDomain(){ }


		public function setDefaultDomain($domain){ }


		public function setDirectory($directory){ }


		public function setLocale($category, $locale){ }


		protected function prepareOptions($options){ }


		protected function getOptionsDefault(){ }

	}
}
