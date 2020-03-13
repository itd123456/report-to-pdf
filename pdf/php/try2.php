<?php

	Class numberToWord
	{
		public function convert($number)
		{
			$strlen = strlen($number);
			
			if($strlen > 9)
			{
				if ($strlen == 12)
				{
					$billion = substr($number, 0, 3);
					$million = substr($number, 3, 3);
					$thousand = substr($number, 6, 3);
					$hundred = substr($number, 9, 3);
				}
				else if ($strlen == 11)
				{
					$billion = substr($number, 0, 2);
					$million = substr($number, 2, 3);
					$thousand = substr($number, 5, 3);
					$hundred = substr($number, 8, 3);
				}
				else if ($strlen == 10)
				{
					$billion = substr($number, 0, 1);
					$million = substr($number, 1, 3);
					$thousand = substr($number, 4, 3);
					$hundred = substr($number, 7, 3);
				}

				$b = $this->word($billion, ' Billion');

				if ($million != '000')
				{
					$m = $this->word($million, ' Million');
				}
				else
				{
					$m = '';
				}

				if ($thousand != '000')
				{
					$t = $this->word($thousand, ' Thousand');	
				}
				else
				{
					$t = '';
				}

				if ($hundred != '000')
				{
					$h = $this->word($hundred, '');
				}
				else
				{
					$h = '';
				}

				$converted = $b.' '.$m.' '.$t.' '.$h;
				
				return $converted;
			}
			else if ($strlen > 6 && $strlen < 10)
			{
				if ($strlen == 9)
				{
					$million = substr($number, 0, 3);
					$thousand = substr($number, 3, 3);
					$hundred = substr($number, 6, 3);
				}
				else if ($strlen == 8)
				{
					$million = substr($number, 0, 2);
					$thousand = substr($number, 2, 3);
					$hundred = substr($number, 5, 3);
				}
				else if ($strlen == 7)
				{
					$million = substr($number, 0, 1);
					$thousand = substr($number, 1, 3);
					$hundred = substr($number, 4, 3);
				}

				$m = $this->word($million, ' Million');

				if ($thousand != '000')
				{
					$t = $this->word($thousand, ' Thousand');	
				}
				else
				{
					$t = '';
				}

				if ($hundred != '000')
				{
					$h = $this->word($hundred, '');
				}
				else
				{
					$h = '';
				}

				$converted = $m.' '.$t.' '.$h;
				
				return $converted;
			}

			else if ($strlen > 3 && $strlen < 7) 
			{
				if ($strlen == 6)
				{
					$thousand = substr($number, 0, 3);
					$hundred = substr($number, 3, 3);
				}
				else if ($strlen == 5)
				{
					$thousand = substr($number, 0, 2);
					$hundred = substr($number, 2, 3);
				}
				else if ($strlen == 4) 
				{
					$thousand = substr($number, 0, 1);
					$hundred = substr($number, 1, 3);
				}

				$t = $this->word($thousand, ' Thousand');	

				if ($hundred != '000')
				{
					$h = $this->word($hundred, '');
				}
				else
				{
					$h = '';
				}

				$converted = $t.' '.$h;
				
				return $converted;
			}
			else if ($strlen < 4)
			{
				if ($strlen == 3)
				{
					$hundred = substr($number, 0, 3);
				}
				else if ($strlen == 2) 
				{
					$hundred = substr($number, 0, 2);
				}
				else if ($strlen == 1)
				{
					$hundred = substr($number, 0, 1);
				}

				$h = $this->word($hundred, '');

				$converted = $h;
				
				return $converted;
			}
			
			// else if($strlen == 6)
			// {
			// 	$thousand = substr($number, 0, 3);
			// 	$hundred = substr($number, 3, 3);

			// 	$t = $this->thousands($thousand, ' Thousand', '', 'Hundred ');
			// 	$h = $this->thousands($hundred, '', '', 'Hundred ');

			// 	$converted = $t.' '.$h;

			// 	return $converted;
			// }
			// else if($strlen == 5)
			// {
			// 	$thousand = substr($number, 0, 2);
			// 	$hundred = substr($number, 2, 3);

			// 	$t = $this->thousands($thousand, ' Thousand', '', ' ');
			// 	$h = $this->thousands($hundred, '', '', 'Hundred ');

			// 	$converted = $t.' '.$h;

			// 	return $converted;
			// }
			// else if($strlen == 4)
			// {
			// 	$thousand = substr($number, 0, 1);
			// 	$hundred = substr($number, 1, 3);

			// 	$t = $this->thousands($thousand, ' Thousand', '', ' ');
			// 	$h = $this->thousands($hundred, '', '', 'Hundred ');

			// 	$converted = $t.' '.$h;

			// 	return $converted;
			// }
			// else if($strlen == 3)
			// {
			// 	$hundred = substr($number, 0, 3);

			// 	$h = $this->word($hundred, '', '');

			// 	$converted = $h;

			// 	return $converted;
			// }
			// else if($strlen == 2)
			// {
			// 	$hundred = substr($number, 0, 2);

			// 	$h = $this->tensOnes($hundred);

			// 	$converted = $h;

			// 	return $converted;
			// }
			// else if($strlen == 1)
			// {
			// 	$hundred = substr($number, 0, 1);

			// 	$h = $this->tensOnes($hundred);

			// 	$converted = $h;

			// 	return $converted;
			// }
		}

		public function word($number, $word)
		{
			$strlen = strlen($number);

			$t = '';
			$h = '';
			$ten = '';
			$ones = '';
			$hundred = '';
			$hundreWord = '';

			if ($strlen == 3)
			{
				$hundred = substr($number, 0, 1);
				$ten = substr($number, 1, 1);
				$ones = substr($number, 2, 1);

				$h = $this->ones($hundred);
			}
			else if ($strlen == 2)
			{
				$ten = substr($number, 0, 1);
				$ones = substr($number, 1, 1);
			}
			else
			{
				$ones = substr($number, 0, 1);
			}

			if ($ten != '0' && $ones == '0')
			{
				$t = $this->tens($ten);
			}
			else if ($ten == '1' && $ones != '0')
			{
				$teen = substr($number, 1, 2);

				if ($strlen == 2)
				{
					$teen = substr($number, 0, 2);
				}			
				
				$t = $this->teens($teen);
			}
			else if (($ten != '1' || $ten != '0') && $ones != '0')
			{	
				$t = $this->tens($ten);
				$o = $this->ones($ones);

				$t = $t.' '.$o;
			}

			$hundreWord = '';

			if ($h)
			{
				$hundreWord = $h.' Hundred'.' '.$t.$word;
			}
			else
			{
				$hundreWord = $t.$word;
			}
			
			return $hundreWord;
		}

		public function millions($number, $word, $and, $hh)
		{
			$strlen = strlen($number);

			$t = '';
			$h = '';
			$ten = '';
			$ones = '';
			$hundred = '';
			$hundreWord = '';

			if ($strlen == 3)
			{
				$hundred = substr($number, 0, 1);
				$ten = substr($number, 1, 1);
				$ones = substr($number, 2, 1);

				$h = $this->ones($hundred);
			}
			else if ($strlen == 2)
			{
				$ten = substr($number, 0, 1);
				$ones = substr($number, 1, 1);
			}
			else
			{
				$ones = substr($number, 0, 1);
			}
			
			
			if ($ten != '0' && $ones == '0')
			{
				$t = $this->tens($ten);
			}
			else if ($ten == '1' && $ones != '0')
			{
				$teen = substr($number, 1, 2);

				if ($strlen == 2)
				{
					$teen = substr($number, 0, 2);
				}	
				
				$t = $this->teens($teen);
			}
			else if (($ten != '1' || $ten != '0') && $ones != '0')
			{	
				$t = $this->tens($ten);
				$o = $this->ones($ones);

				$t = $t.' '.$o;
			}

			if ($hundred == '0')
			{
				$hundreWord = $and.$t.$word;
			}
			else
			{
				$hundreWord = $h.' '.$hh.$t.$word;
			}
			
			return $hundreWord;
		}

		public function thousands($number, $word, $and, $hh)
		{
			$strlen = strlen($number);

			$t = '';
			$h = '';
			$ten = '';
			$ones = '';
			$hundred = '';
			$hundreWord = '';

			if ($strlen == 3)
			{
				$hundred = substr($number, 0, 1);
				$ten = substr($number, 1, 1);
				$ones = substr($number, 2, 1);

				$h = $this->ones($hundred);
			}
			else if ($strlen == 2)
			{
				$ten = substr($number, 0, 1);
				$ones = substr($number, 1, 1);
			}
			else
			{
				$ones = substr($number, 0, 1);
			}
			
			
			if ($ten != '0' && $ones == '0')
			{
				$t = $this->tens($ten);
			}
			else if ($ten == '1' && $ones != '0')
			{
				$teen = substr($number, 1, 2);

				if ($strlen == 2)
				{
					$teen = substr($number, 0, 2);
				}	
				
				$t = $this->teens($teen);
			}
			else if (($ten != '1' || $ten != '0') && $ones != '0')
			{	
				$t = $this->tens($ten);
				$o = $this->ones($ones);

				$t = $t.' '.$o;
			}

			if ($hundred == '0')
			{
				$hundreWord = $and.$t.$word;
			}
			else
			{
				$hundreWord = $h.' '.$hh.$t.$word;
			}
			
			return $hundreWord;
		}

		public function tensOnes($number)
		{
			$strlen = strlen($number);

			$hundreWord = '';

			if ($strlen == 2)
			{
				$ten = substr($number, 0, 1);
				$ones = substr($number, 1, 1);

				$t = '';

				if ($ten != '0' && $ones == '0')
				{
					$t = $this->tens($ten);
				}
				else if ($ten == '1' && $ones != '0')
				{
					$teen = substr($number, 1, 2);			
					
					$t = $this->teens($teen);
				}
				else if (($ten != '1' || $ten != '0') && $ones != '0')
				{	
					$t = $this->tens($ten);
					$o = $this->ones($ones);

					$t = $t.' '.$o;
				}
			}
			else
			{
				$ones = substr($number, 0, 1);
				$t = $this->ones($ones);
			}

			$hundreWord = $t;
			
			return $hundreWord;
		}

		public function ones($number)
		{
			if ($number == 1)
			{
				return 'One';
			}
			else if ($number == 2)
			{
				return 'Two';
			}
			else if ($number == 3)
			{
				return 'Three';
			}
			else if ($number == 4)
			{
				return 'Four';
			}
			else if ($number == 5)
			{
				return 'Five';
			}
			else if ($number == 6)
			{
				return 'Six';
			}
			else if ($number == 7)
			{
				return 'Seven';
			}
			else if ($number == 8)
			{
				return 'Eight';
			}
			else if ($number == 9)
			{
				return 'Nine';
			}
			else
			{
				return '';
			}
		}

		public function tens($number)
		{	
			if ($number == 1)
			{
				return 'Ten';
			}
			else if ($number == 2)
			{
				return 'Twenty';
			}
			else if ($number == 3)
			{
				return 'Thirty';
			}
			else if ($number == 4)
			{
				return 'Forty';
			}
			else if ($number == 5)
			{
				return 'Fifty';
			}
			else if ($number == 6)
			{
				return 'Sixty';
			}
			else if ($number == 7)
			{
				return 'Seventy';
			}
			else if ($number == 8)
			{
				return 'Eighty';
			}
			else if ($number == 9)
			{
				return 'Ninety';
			}
			else
			{
				return '';
			}
		}

		public function teens($number)
		{
			if ($number == 11)
			{
				return 'Eleven';
			}
			else if ($number == 12)
			{
				return 'Twelve';
			}
			else if ($number == 13)
			{
				return 'Thirteen';
			}
			else if ($number == 14)
			{
				return 'Fourteen';
			}
			else if ($number == 15)
			{
				return 'Fifteen';
			}
			else if ($number == 16)
			{
				return 'Sixteen';
			}
			else if ($number == 17)
			{
				return 'Seventeen';
			}
			else if ($number == 18)
			{
				return 'Eighteen';
			}
			else if ($number == 19)
			{
				return 'Nineteen';
			}
			else
			{
				return '';
			}
		}
	}

?>