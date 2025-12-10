<?php
$input = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$N = intval($input[0]); $K = intval($input[1]); $idx=2;
$A = [];
for ($i=0;$i<$N;$i++) $A[] = intval($input[$idx++]);
$sum = array_sum(array_slice($A,0,$K));
$best = $sum;
for ($i=$K;$i<$N;$i++){
    $sum += $A[$i] - $A[$i-$K];
    if ($sum > $best) $best = $sum;
}
// 出力は平均の整数部分（floor）
$avg = floor($best / $K);
echo $avg . "\n";
