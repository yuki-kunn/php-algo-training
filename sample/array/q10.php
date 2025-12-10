<?php
$input = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$N = intval($input[0]);
$Q = intval($input[1]);
$idx = 2;
$A = [];
for ($i=0;$i<$N;$i++) { $A[] = intval($input[$idx++]); }
$psum = array_fill(0, $N+1, 0);
for ($i=0;$i<$N;$i++) $psum[$i+1] = $psum[$i] + $A[$i];
for ($qi=0;$qi<$Q;$qi++){
    $l = intval($input[$idx++]);
    $r = intval($input[$idx++]);
    // assuming 1-indexed inclusive [l, r]
    $sum = $psum[$r] - $psum[$l-1];
    echo $sum . "\n";
}
