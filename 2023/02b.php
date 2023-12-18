<?php

$result = 0;
$input = file_get_contents("02i.txt");
$separator = "\r\n";
$line = strtok($input, $separator);

while ($line !== false) {
  $line_exploded = explode(":", $line);
  $game_id = str_replace("Game ", "", $line_exploded[0]);
  $sets = explode(";", $line_exploded[1]);

  // Reset game requirements.
  $game_requirements = ['red' => 0, 'green' => 0, 'blue' => 0];
  foreach ($sets as $set) {
    $grabs = explode(",", $set);
    foreach ($grabs as $grab) {
      $balls = explode(" ", trim($grab));

      // If current pick of balls has more of a color than the previous max requirement, set this new quantity as the max.
      if ($game_requirements[$balls[1]] < $balls[0]) {
        $game_requirements[$balls[1]] = $balls[0];
      }
    }
  }

  $set_power = $game_requirements['red'] * $game_requirements['blue'] * $game_requirements['green'];

  $result = $result + $set_power;

  // Next line from input.
  $line = strtok($separator);
}

echo "Answer: " . $result . "\n";
