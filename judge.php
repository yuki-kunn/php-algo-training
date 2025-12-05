<?php
/**
 * judge.php  (汎用版)
 *
 * Usage:
 *   php judge.php q01
 *   php judge.php q14
 *
 * 対応テストケース形式:
 *   tests/q01_in.txt
 *   tests/q01_out.txt
 *   複数ケース:
 *     tests/q01_in1.txt
 *     tests/q01_out1.txt
 */

if ($argc < 2) {
    echo "Usage: php judge.php qXX\n";
    exit(1);
}

$problem = $argv[1]; // q14 のような形式
$projectRoot = realpath(__DIR__);
$testsDir = $projectRoot . DIRECTORY_SEPARATOR . 'tests';

// -------------------------------
// 1. src/配下から対象 PHP ファイルを検索
// -------------------------------
function findProblemFile($problemName, $root) {
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root . '/src', FilesystemIterator::SKIP_DOTS)
    );
    foreach ($it as $file) {
        if ($file->isFile() && $file->getFilename() === $problemName . '.php') {
            return $file->getPathname();
        }
    }
    return null;
}

$problemFile = findProblemFile($problem, $projectRoot);
if (!$problemFile) {
    echo "Error: cannot find file: src/**/{$problem}.php\n";
    exit(1);
}

echo "=== Judge: {$problem} ===\n";
echo "Problem file: {$problemFile}\n\n";

// -------------------------------
// 2. テストケースを収集
// -------------------------------
$pattern = "{$testsDir}/{$problem}_in*.txt";
$inputFiles = glob($pattern);
sort($inputFiles, SORT_NATURAL);

if (empty($inputFiles)) {
    echo "Error: no input files found: {$problem}_in*.txt\n";
    exit(1);
}

$total = 0;
$pass  = 0;

// -------------------------------
// 3. 各テストを実行 & 判定
// -------------------------------
foreach ($inputFiles as $inFile) {
    $base = basename($inFile); // q14_in.txt / q14_in1.txt...
    $expectedName = preg_replace('/_in/', '_out', $base, 1);
    $expectedPath = "{$testsDir}/{$expectedName}";

    if (!file_exists($expectedPath)) {
        echo "[SKIP] expected missing: {$expectedName}\n";
        continue;
    }

    $total++;

    // 実行
    $cmd = "php " . escapeshellarg($problemFile) . " < " . escapeshellarg($inFile);
    $rawOutput = shell_exec($cmd);

    // 出力の正規化
    $normalize = function($s) {
        if ($s === null) $s = "";
        $s = str_replace(["\r\n", "\r"], "\n", $s);   // 改行統一
        $s = preg_replace("/[ \t]+$/m", "", $s);      // 行末空白除去
        return trim($s, "\n");
    };

    $actual   = $normalize($rawOutput);
    $expected = $normalize(file_get_contents($expectedPath));

    if ($actual === $expected) {
        echo "[OK]  {$base}\n";
        $pass++;
    } else {
        echo "---- [NG] {$base} ----\n";
        echo "Input : {$inFile}\n";
        echo "Expect: {$expectedPath}\n\n";
        echo "Expected:\n{$expected}\n----\n";
        echo "Actual:\n{$actual}\n";
        echo "---------------------------\n\n";
    }
}

echo "Result: {$pass} / {$total} passed.\n";
