<?php

class ChangeString 
{

	protected $alphabet = 'abcdefghijklmnopqrstuvwxyz';

	protected $alphabetLetters = [];

	/*
	 *
	 */
	public function __construct()
	{
		$this->alphabetLetters = str_split($this->alphabet);
	}

	/*
	 * @param string $str
	 *
	 * @return string
	 */
	public function build($str)
	{
		$letters = str_split($str);		
		$count = count($this->alphabetLetters) - 1;

		$result = [];
		foreach($letters as $letter) {
			if ( ctype_alpha($letter) ) {
				$mayus = false;
				if( ctype_upper($letter) ) {
					$mayus = true;
					$letter = strtolower($letter);
				}

				$newposition = -1;
				$position = $this->getPositionInAlphabet($letter);
				if( $position >= $count ) {
					$newposition = 0;
				} else {
					$newposition = $position + 1;
				}
				$result[] = $this->getLetterFromAlphabet($newposition, $mayus);
				
			} else {
				$result[] = $letter;
			}
		}

		return join($result);
	}

	/*
	 * @param string $letter null
	 *
	 * @return integer
	 */
	protected function getPositionInAlphabet($letter = null)
	{
		return array_search($letter, $this->alphabetLetters);
	}

	/*
	 * @param intgeger $position
	 * @param boolean $mayus false
	 * @return string
	 */
	protected function getLetterFromAlphabet($position, $mayus = false)
	{
		if ( $mayus === true ) {
			 return strtoupper($this->alphabetLetters[$position]);
		}

		return $this->alphabetLetters[$position];
	}

}

// Uncomment for execute
/*
$word = '"**Casa 52Z';
$changeString = new ChangeString;
$result = $changeString->build($word);

echo $result;
*/