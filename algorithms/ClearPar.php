<?php

class ClearPar 
{

	/*
	 * @param string $str
	 *
	 * @return string
	 */
	public function build($str)
	{
		preg_match_all('/\(\)/',$str, $match);

		return join(current($match));
	}

}

// Uncomment for execute
/*
$str = '()()(()';
$clearPar = new ClearPar;
$result = $clearPar->build($str);

echo $result;
*/