<?php
$input = array_values(array_filter(array_map('rtrim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
list($H, $W) = array_map('intval', preg_split('/\s+/', $input[0]));
$grid = [];
$py=$px=null;
for ($i=0;$i<$H;$i++){
    $row = str_split($input[1+$i]);
    $grid[] = $row;
    for ($j=0;$j<$W;$j++){
        if ($row[$j] === 'P') { $py=$i; $px=$j; }
    }
}
$idx = 1+$H;
$k = intval($input[$idx]);
$cmds = preg_split('/\s+/', $input[$idx+1]);
$y=$py; $x=$px;
foreach ($cmds as $c) {
    $ny=$y; $nx=$x;
    if ($c === 'U') $ny--;
    if ($c === 'D') $ny++;
    if ($c === 'L') $nx--;
    if ($c === 'R') $nx++;
    if ($ny<0||$ny>=$H||$nx<0||$nx>=$W) continue;
    if ($grid[$ny][$nx] === '#') continue;
    $y=$ny; $x=$nx;
    if ($grid[$y][$x] === 'T') { echo "YES\n"; exit; }
}
echo "NO\n";
