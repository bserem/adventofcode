<?php

$result = 0;
$input = file_get_contents("02i.txt");
$separator = "\r\n";
$line = strtok($input, $separator);

$max = [
  "red" => 12,
  "green" => 13,
  "blue" => 14,
];

$game_possible = [];

while ($line !== false) {
  $line_exploded = explode(":", $line);
  $game_id = str_replace("Game ", "", $line_exploded[0]);
  $sets = explode(";", $line_exploded[1]);


  foreach ($sets as $set) {
    $grab_keyed = [];
    $grabs = explode(",", $set);
    foreach ($grabs as $grab) {

      $balls = explode(" ", trim($grab));
      // Create an array of [colour => number]
      $grab_keyed[$balls[1]] = $balls[0];
    }

    // $grab_keyed now represents how many balls of every color were picked by the elf.
    foreach ($grab_keyed as $color => $quantity) {
      if ($max[$color] < $quantity) {
        // This set is impossible.
        $game_possible[$game_id] = false;
        break 2;
      }

      // Reachable if we don't break above.
      $game_possible[$game_id] = true;
    }
  }

  // Next line from input.
  $line = strtok($separator);
}

foreach ($game_possible as $id => $possible) {
  if ($possible) {
    $result += $id;
  };
}
echo "Answer: " . $result . "\n";
