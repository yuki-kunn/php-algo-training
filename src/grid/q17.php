<?php
$input = array_values(array_filter(array_map('rtrim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
list($H, $W) = array_map('intval', preg_split('/\s+/', $input[0]));
$grid = [];
$sy = $sx = null;
$ty = $tx = null;
for ($i=0;$i<$H;$i++){
    $row = str_split($input[1+$i]);
    $grid[] = $row;
    for ($j=0;$j<$W;$j++){
        if ($row[$j] === 'S') { $sy=$i; $sx=$j; }
        if ($row[$j] === 'T') { $ty=$i; $tx=$j; }
    }
}
$lineIdx = 1+$H;
$k = intval($input[$lineIdx]);
$cmds = preg_split('/\s+/', $input[$lineIdx+1]);
$y=$sy; $x=$sx;
foreach ($cmds as $c) {
    $ny=$y; $nx=$x;
    if ($c === 'U') $ny--;
    if ($c === 'D') $ny++;
    if ($c === 'L') $nx--;
    if ($c === 'R') $nx++;
    if ($ny<0||$ny>=$H||$nx<0||$nx>=$W) continue;
    if ($grid[$ny][$nx] === '#') continue;
    $y=$ny; $x=$nx;
}
echo $y . ' ' . $x . "\n";
