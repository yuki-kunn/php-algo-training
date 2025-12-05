<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$n = intval($lines[0]);
$q = [];
for ($i=1;$i<=$n;$i++){
    $parts = preg_split('/\s+/', $lines[$i]);
    if ($parts[0] === 'arrive') {
        $q[] = $parts[1] ?? null;
    } elseif ($parts[0] === 'serve') {
        if (count($q)>0) array_shift($q);
    }
}
echo count($q) . "\n";
