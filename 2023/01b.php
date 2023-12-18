<?php

$input = file_get_contents('01i.txt');
$separator = "\r\n";

$numbers = [];

// Ugly hacky way, we need to map sequences like 'eighthree' into both 8 and 3.
$wordToDigit = [
  'one' => 'o1e',
  'two' => 't2o',
  'three' => 't3e',
  'four' => 'f4r',
  'five' => 'f5e',
  'six' => 's6x',
  'seven' => 's7n',
  'eight' => 'e8t',
  'nine' => 'n9e',
];


$line = strtok($input, $separator);

while ($line !== false) {
  $line = str_replace(array_keys($wordToDigit), $wordToDigit, $line);
  $n = preg_replace("~\D~", "", $line);
  if (strlen($n) === 1) {
    $n .= $n;
  }
  if (strlen($n) > 2) {
    $n = $n[0] . $n[strlen($n)-1];
  }
  $numbers[] = $n;
  $line = strtok($separator);
};

$sum = 0;
foreach ($numbers as $number) {
  $sum += $number;
}

echo "Answer: " . $sum . "\n";

