<?php
$input = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$n = intval($input[0]);
$nums = array_map('intval', preg_split('/\s+/', $input[1]));
$x = intval($input[2]);
$out = array_filter($nums, function($v) use ($x){ return $v >= $x; });
if (count($out)===0) { echo "\n"; }
else { echo implode(' ', $out) . "\n"; }
