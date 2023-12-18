<?php

$input = file_get_contents('01i.txt');
$separator = "\r\n";
$line = strtok($input, $separator);

$numbers = [];

while ($line !== false) {
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

