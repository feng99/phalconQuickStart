<?php 

namespace Phalcon\Queue\Beanstalk {

	class Job {

		protected $_id;

		protected $_body;

		protected $_queue;

		public function getId(){ }


		public function getBody(){ }


		public function __construct(\Phalcon\Queue\Beanstalk $queue, $id, $body){ }


		public function delete(){ }


		public function release($priority=null, $delay=null){ }


		public function bury($priority=null){ }


		public function touch(){ }


		public function kick(){ }


		public function stats(){ }


		public function __wakeup(){ }

	}
}
