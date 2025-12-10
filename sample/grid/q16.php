<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
list($H, $W) = array_map('intval', preg_split('/\s+/', $lines[0]));
$grid = [];
for ($i=0;$i<$H;$i++){
    $grid[] = array_map('intval', preg_split('/\s+/', $lines[1+$i]));
}
[$qy, $qx] = array_map('intval', preg_split('/\s+/', $lines[1+$H]));
// given coordinates appear 0-indexed? sample used 1 1 for center in 3x3 expecting sum 20 (2+8+4+6) -> coordinates (1,1) zero-index.
$sum = 0;
$dirs = [[-1,0],[1,0],[0,-1],[0,1]];
foreach ($dirs as $d) {
    $ny = $qy + $d[0]; $nx = $qx + $d[1];
    if ($ny>=0 && $ny<$H && $nx>=0 && $nx<$W) $sum += $grid[$ny][$nx];
}
echo $sum . "\n";
