<?php

namespace GeTui\Notification\Protobuf\Type;
use GeTui\Notification\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBScalar extends PBMessage
{
	/**
	 * Set scalar value
	 */
	public function set_value($value)
	{
		$this->value = $value;	
	}

	/**
	 * Get the scalar value
	 */
	public function get_value()
	{
		return $this->value;
	}
}
?>
