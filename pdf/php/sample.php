<?php

	require('numberToWord.php');

	$ntw = new numberToWord();

	$converted = $ntw->convert('160');

	print_r($converted);
?>