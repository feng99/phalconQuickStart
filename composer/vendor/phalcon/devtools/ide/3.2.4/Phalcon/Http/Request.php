<?php 

namespace Phalcon\Http {

	class Request implements \Phalcon\Http\RequestInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_rawBody;

		protected $_filter;

		protected $_putCache;

		protected $_httpMethodParameterOverride;

		protected $_strictHostCheck;

		public function getHttpMethodParameterOverride(){ }


		public function setHttpMethodParameterOverride($httpMethodParameterOverride){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function get($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		public function getPost($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		public function getPut($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		public function getQuery($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		final protected function getHelper($source, $name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		public function getServer($name){ }


		public function has($name){ }


		public function hasPost($name){ }


		public function hasPut($name){ }


		public function hasQuery($name){ }


		final public function hasServer($name){ }


		final public function getHeader($header){ }


		public function getScheme(){ }


		public function isAjax(){ }


		public function isSoap(){ }


		public function isSoapRequested(){ }


		public function isSecure(){ }


		public function isSecureRequest(){ }


		public function getRawBody(){ }


		public function getJsonRawBody($associative=null){ }


		public function getServerAddress(){ }


		public function getServerName(){ }


		public function getHttpHost(){ }


		public function setStrictHostCheck($flag=null){ }


		public function isStrictHostCheck(){ }


		public function getPort(){ }


		final public function getURI(){ }


		public function getClientAddress($trustForwardedHeader=null){ }


		final public function getMethod(){ }


		public function getUserAgent(){ }


		public function isValidHttpMethod($method){ }


		public function isMethod($methods, $strict=null){ }


		public function isPost(){ }


		public function isGet(){ }


		public function isPut(){ }


		public function isPatch(){ }


		public function isHead(){ }


		public function isDelete(){ }


		public function isOptions(){ }


		public function isPurge(){ }


		public function isTrace(){ }


		public function isConnect(){ }


		public function hasFiles($onlySuccessful=null){ }


		final protected function hasFileHelper($data, $onlySuccessful){ }


		public function getUploadedFiles($onlySuccessful=null){ }


		final protected function smoothFiles($names, $types, $tmp_names, $sizes, $errors, $prefix){ }


		public function getHeaders(){ }


		public function getHTTPReferer(){ }


		final protected function _getBestQuality($qualityParts, $name){ }


		public function getContentType(){ }


		public function getAcceptableContent(){ }


		public function getBestAccept(){ }


		public function getClientCharsets(){ }


		public function getBestCharset(){ }


		public function getLanguages(){ }


		public function getBestLanguage(){ }


		public function getBasicAuth(){ }


		public function getDigestAuth(){ }


		final protected function _getQualityHeader($serverIndex, $name){ }

	}
}
