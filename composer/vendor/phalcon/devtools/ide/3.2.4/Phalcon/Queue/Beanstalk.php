<?php 

namespace Phalcon\Queue {

	class Beanstalk {

		const DEFAULT_DELAY = 0;

		const DEFAULT_PRIORITY = 100;

		const DEFAULT_TTR = 86400;

		const DEFAULT_TUBE = default;

		const DEFAULT_HOST = 127.0.0.1;

		const DEFAULT_PORT = 11300;

		protected $_connection;

		protected $_parameters;

		public function __construct($parameters=null){ }


		public function connect(){ }


		public function put($data, $options=null){ }


		public function reserve($timeout=null){ }


		public function choose($tube){ }


		public function watch($tube){ }


		public function ignore($tube){ }


		public function pauseTube($tube, $delay){ }


		public function kick($bound){ }


		public function stats(){ }


		public function statsTube($tube){ }


		public function listTubes(){ }


		public function listTubeUsed(){ }


		public function listTubesWatched(){ }


		public function peekReady(){ }


		public function peekBuried(){ }


		public function peekDelayed(){ }


		public function jobPeek($id){ }


		final public function readStatus(){ }


		final public function readYaml(){ }


		public function read($length=null){ }


		public function write($data){ }


		public function disconnect(){ }


		public function quit(){ }

	}
}
