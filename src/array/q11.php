<?php
$input = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$n = intval($input[0]); $idx=1;
$A = [];
for ($i=0;$i<$n;$i++) $A[] = intval($input[$idx++]);
$max = 0; $cur = 0;
foreach ($A as $v) {
    if ($v > 0) { $cur++; if ($cur > $max) $max = $cur; }
    else { $cur = 0; }
}
echo $max . "\n";
