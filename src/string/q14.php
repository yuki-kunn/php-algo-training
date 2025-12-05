<?php
$line = trim(stream_get_contents(STDIN));
$words = preg_split('/\s+/', trim($line));
$freq = [];
foreach ($words as $w) {
    if ($w === '') continue;
    if (!isset($freq[$w])) $freq[$w] = 0;
    $freq[$w]++;
}
arsort($freq); // frequency desc, key preserved
foreach ($freq as $k => $v) {
    echo $k . ' ' . $v . "\n";
}
