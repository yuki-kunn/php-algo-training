<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$T = intval($lines[0]);
$n = intval($lines[1]);
for ($i=0;$i<$n;$i++){
    $s = trim($lines[2+$i]);
    $T += intval($s);
}
echo $T . "\n";
