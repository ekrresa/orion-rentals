<h1>Week 8 Task</h1>

<?php

	$count = 0;

	for ($i=1980; $i <= 2018; $i++) {

		if (leapYear($i)) {
			echo "<strong>$i Leap Year</strong><br>";
			$count++;
		}
		else {
			echo $i."<br>";
		}

	}
	// Output number of Leap Years
	echo "<strong><p>The number of Leap Years between 1980 and 2018 is $count</p></strong>";

	// Leap Year Function
	function leapYear ($year) {
		return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) ? true : false;
	}

?>