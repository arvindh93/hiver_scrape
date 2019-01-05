<?php
include_once('simple_html_dom.php');

$htmlContent = file_get_html('https://www.hiverhq.com')->plaintext;
$words = preg_split('/(\s|\n)+/i', $htmlContent);
$wordCount = [];

foreach ($words as $word) {
  $wordInLowerCase = strtolower($word);
  if (!empty($wordCount[$wordInLowerCase])) {
    $wordCount[$wordInLowerCase]++;
  } else {
    $wordCount[$wordInLowerCase] = 1;
  }
}

uasort($wordCount, function ($a, $b) {
  if ($a < $b) {
    return 1;
  } else {
    return -1;
  }
});

$counterLimit = readline("Enter how many number of most common occurences to be listed (defaults to 5): ");
if (!is_numeric($counterLimit)) {
  $counterLimit = 5;
}

$counter = 1;
foreach ($wordCount as $word => $count) {
  if ($counter > $counterLimit) {
    break;
  }

  echo "'{$word}' occured {$count} times\n";
  $counter++;
}
