<?php
$input = explode("\n", trim(stream_get_contents(STDIN)));
$s = isset($input[0]) ? rtrim($input[0], "\r\n") : '';
$t = isset($input[1]) ? rtrim($input[1], "\r\n") : '';
if ($t === '') { echo "0\n"; exit; }
echo substr_count($s, $t) . "\n";
