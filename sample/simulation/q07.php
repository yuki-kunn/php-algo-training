<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$M = intval($lines[0]);
$n = intval($lines[1]);
$cur = 0;
for ($i=0;$i<$n;$i++){
    [$cmd, $num] = array_pad(preg_split('/\s+/', $lines[2+$i]), 2, 0);
    $num = intval($num);
    if ($cmd === 'in') $cur += $num;
    if ($cmd === 'out') $cur -= $num;
    if ($cur > $M) { echo "error\n"; exit; }
    if ($cur < 0) $cur = 0;
}
echo $cur . "\n";
