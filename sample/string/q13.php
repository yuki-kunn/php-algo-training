<?php
$s = trim(stream_get_contents(STDIN));
$s = rtrim($s, "\r\n");
$out = '';
for ($i=0;$i<strlen($s);$i++){
    $c = $s[$i];
    if ($c>='a' && $c<='z') {
        $o = ord($c) - ord('a');
        $o = ($o + 3) % 26;
        $out .= chr($o + ord('a'));
    } else {
        $out .= $c;
    }
}
echo $out . "\n";
