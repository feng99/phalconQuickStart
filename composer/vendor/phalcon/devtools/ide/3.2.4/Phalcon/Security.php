<?php 

namespace Phalcon {

	class Security implements \Phalcon\Di\InjectionAwareInterface {

		const CRYPT_DEFAULT = 0;

		const CRYPT_STD_DES = 1;

		const CRYPT_EXT_DES = 2;

		const CRYPT_MD5 = 3;

		const CRYPT_BLOWFISH = 4;

		const CRYPT_BLOWFISH_A = 5;

		const CRYPT_BLOWFISH_X = 6;

		const CRYPT_BLOWFISH_Y = 7;

		const CRYPT_SHA256 = 8;

		const CRYPT_SHA512 = 9;

		protected $_dependencyInjector;

		protected $_workFactor;

		protected $_numberBytes;

		protected $_tokenKeySessionID;

		protected $_tokenValueSessionID;

		protected $_token;

		protected $_tokenKey;

		protected $_random;

		protected $_defaultHash;

		public function setWorkFactor($workFactor){ }


		public function getWorkFactor(){ }


		public function __construct(){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setRandomBytes($randomBytes){ }


		public function getRandomBytes(){ }


		public function getRandom(){ }


		public function getSaltBytes($numberBytes=null){ }


		public function hash($password, $workFactor=null){ }


		public function checkHash($password, $passwordHash, $maxPassLength=null){ }


		public function isLegacyHash($passwordHash){ }


		public function getTokenKey(){ }


		public function getToken(){ }


		public function checkToken($tokenKey=null, $tokenValue=null, $destroyIfValid=null){ }


		public function getSessionToken(){ }


		public function destroyToken(){ }


		public function computeHmac($data, $key, $algo, $raw=null){ }


		public function setDefaultHash($defaultHash){ }


		public function getDefaultHash(){ }


		public function hasLibreSsl(){ }


		public function getSslVersionNumber(){ }

	}
}
