<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$n = intval($lines[0]);
$val = 0;
for ($i=1;$i<= $n; $i++){
    [$cmd, $num] = array_pad(preg_split('/\s+/', $lines[$i]), 2, 0);
    $num = intval($num);
    if ($cmd === 'add') $val += $num;
    if ($cmd === 'sub') $val -= $num;
}
echo $val . "\n";
