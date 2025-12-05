<?php
$input = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
if (count($input) < 2) exit;
$k = intval($input[0]);
$cmds = array_slice($input, 1);
$x = 0; $y = 0;
foreach ($cmds as $c) {
    if ($c === 'N') $y++;
    if ($c === 'S') $y--;
    if ($c === 'E') $x++;
    if ($c === 'W') $x--;
}
echo $x . ' ' . $y . "\n";
