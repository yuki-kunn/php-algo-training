<?php
$in = array_values(array_filter(array_map('trim', explode("\n", trim(stream_get_contents(STDIN)))), function($v){return $v!=='';}));
$s = $in[0] ?? '';
$p = $in[1] ?? '';
// convert pattern with single '*' to regex
$regex = '/^' . str_replace('\*', '.*', preg_quote($p, '/')) . '$/';
if (preg_match($regex, $s)) echo "YES\n"; else echo "NO\n";
