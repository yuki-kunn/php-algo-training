<?php
$lines = array_values(array_filter(array_map('rtrim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
list($H, $W) = array_map('intval', preg_split('/\s+/', $lines[0]));
$grid = [];
for ($i=0;$i<$H;$i++) $grid[] = str_split($lines[1+$i]);
$visited = array_fill(0,$H, array_fill(0,$W,false));
$dirs = [[1,0],[-1,0],[0,1],[0,-1]];
$best = 0;
for ($i=0;$i<$H;$i++){
    for ($j=0;$j<$W;$j++){
        if ($grid[$i][$j] === '.' && !$visited[$i][$j]) {
            $cnt = 0;
            $stack = [[$i,$j]];
            $visited[$i][$j] = true;
            while ($stack) {
                [$y,$x] = array_pop($stack);
                $cnt++;
                foreach ($dirs as $d) {
                    $ny=$y+$d[0]; $nx=$x+$d[1];
                    if ($ny<0||$ny>=$H||$nx<0||$nx>=$W) continue;
                    if ($visited[$ny][$nx]) continue;
                    if ($grid[$ny][$nx] !== '.') continue;
                    $visited[$ny][$nx] = true;
                    $stack[] = [$ny,$nx];
                }
            }
            if ($cnt > $best) $best = $cnt;
        }
    }
}
echo $best . "\n";
