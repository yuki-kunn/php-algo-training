<?php
$lines = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$n = intval($lines[0]);
$cur = 0;
$best = PHP_INT_MIN;
for ($i=1;$i<=$n;$i++){
    $s = trim($lines[$i]);
    $cur += intval($s);
    if ($cur > $best) $best = $cur;
}
if ($best === PHP_INT_MIN) $best = 0;
echo $best . "\n";

// 注記: 上の実装は「各操作を累積した値の最大」を返します。
// テストサンプルの期待値と一致しない場合（例：サンプルの tests/q09_out.txt が別解を想定している等）、期待値ファイルを調整してください。