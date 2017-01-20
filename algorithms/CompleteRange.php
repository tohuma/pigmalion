<?php

class CompleteRange 
{

	/*
	 * @param array $numbers
	 * 
	 * @return array
	 */
	public function build($numbers = [])
	{
		$min = min($numbers);
		$max = max($numbers);

		return $this->generateRange($min, $max);
	}

	/*
	 * @param integer $min
	 * @param integer $max
	 * @return array
	 */
	protected function generateRange($min = 0, $max = 0)
	{
		$numbers = range($min, $max);

		return $numbers;
	}
}

// Uncomment for execute
/*
$numbers = [1, 2, 30, 4, 5];
$completeRange = new CompleteRange;
$result = $completeRange->build($numbers);

print_r($result);
*/