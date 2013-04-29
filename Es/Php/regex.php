<?php
/*

1. Data extracting
Input:
An example text:
On February 13, 2009, at exactly 23:31:30 (UTC) the decimal representation of Unix
time was equal to 1234567890. Parties and other celebrations were held around the
world, among various technical subcultures, to celebrate this day.
Output:
Output to the browser all numbers greater than 4 digits contained in the given
input text using PHP.
Guidelines
Use regular expressions
Of course, the output must work whatever is the text given as input
*/


$data = "On February 13, 2009, at exactly 23:31:30 (UTC) the decimal representation of Unix \
time was equal to 1234567890. Parties and other celebrations were held around the \
world, among various technical subcultures, to celebrate this day.";


echo $data;
echo "<br/>";

$pattern = "( \d{4,})";


$result = preg_match_all($pattern , $data, $out);
echo "Number of results ", $result;
echo "<br/>";
if ( $result > 0 ) {
  print_r($out[0]);
}

/*
Data replacing
Input:
The following text:
During the day, Damien is working.
Output:
From the given input, output the following text to the browser:
Damien is happy to work.
Guidelines
Use regular expressions functions only
No more than 2 lines of code expected. Bigger code will be rejected

 */

$data = "During the day, Damien is working.";
echo "<br/>";

echo $data;
echo "<br/>";

echo preg_replace(array('/working/', '/During the day, /'), array('happy to work', ''), $data );
