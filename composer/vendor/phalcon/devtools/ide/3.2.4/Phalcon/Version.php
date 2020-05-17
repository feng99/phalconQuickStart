<?php 

namespace Phalcon {

	class Version {

		const VERSION_MAJOR = 0;

		const VERSION_MEDIUM = 1;

		const VERSION_MINOR = 2;

		const VERSION_SPECIAL = 3;

		const VERSION_SPECIAL_NUMBER = 4;

		protected static function _getVersion(){ }


		final protected static function _getSpecial($special){ }


		public static function get(){ }


		public static function getId(){ }


		public static function getPart($part){ }

	}
}
