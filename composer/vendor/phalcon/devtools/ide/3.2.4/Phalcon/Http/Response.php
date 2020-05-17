<?php 

namespace Phalcon\Http {

	class Response implements \Phalcon\Http\ResponseInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_sent;

		protected $_content;

		protected $_headers;

		protected $_cookies;

		protected $_file;

		protected $_dependencyInjector;

		public function __construct($content=null, $code=null, $status=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setStatusCode($code, $message=null){ }


		public function getStatusCode(){ }


		public function setHeaders(\Phalcon\Http\Response\HeadersInterface $headers){ }


		public function getHeaders(){ }


		public function setCookies(\Phalcon\Http\Response\CookiesInterface $cookies){ }


		public function getCookies(){ }


		public function setHeader($name, $value){ }


		public function setRawHeader($header){ }


		public function resetHeaders(){ }


		public function setExpires(\DateTime $datetime){ }


		public function setLastModified(\DateTime $datetime){ }


		public function setCache($minutes){ }


		public function setNotModified(){ }


		public function setContentType($contentType, $charset=null){ }


		public function setContentLength($contentLength){ }


		public function setEtag($etag){ }


		public function redirect($location=null, $externalRedirect=null, $statusCode=null){ }


		public function setContent($content){ }


		public function setJsonContent($content, $jsonOptions=null, $depth=null){ }


		public function appendContent($content){ }


		public function getContent(){ }


		public function isSent(){ }


		public function sendHeaders(){ }


		public function sendCookies(){ }


		public function send(){ }


		public function setFileToSend($filePath, $attachmentName=null, $attachment=null){ }

	}
}
