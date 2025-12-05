<?php
$input = trim(stream_get_contents(STDIN));
$lines = array_values(array_filter(array_map('trim', explode("\n", $input)), function($v){return $v!=='';}));
if (count($lines) < 2) exit;
$n = intval($lines[0]);
$nums = array_map('intval', preg_split('/\s+/', $lines[1]));
$sum = array_sum($nums);
$max = max($nums);
$min = min($nums);
echo "{$sum} {$max} {$min}\n";