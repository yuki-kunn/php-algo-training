<?php
if ($argc < 2) {
    echo "Usage: php run.php <problem-file> < tests/input.txt\n";
    exit;
}

require $argv[1];
