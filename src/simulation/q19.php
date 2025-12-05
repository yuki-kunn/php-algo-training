<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$T = intval($lines[0]);
$n = intval($lines[1]);
for ($i=0;$i<$n;$i++){
    $cmd = $lines[2+$i];
    if ($cmd === 'sun') $T += 5;
    elseif ($cmd === 'rain') $T -= 3;
    elseif ($cmd === 'cloud') $T += 0;
}
echo $T . "\n";
