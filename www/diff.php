<?php
/*
+----------------------------------------------------------------------+
| PHP Documentation Tools Site Source Code                             |
+----------------------------------------------------------------------+
| Copyright (c) 1997-2017 The PHP Group                                |
+----------------------------------------------------------------------+
| This source file is subject to version 3.0 of the PHP license,       |
| that is bundled with this package in the file LICENSE, and is        |
| available through the world-wide-web at the following url:           |
| http://www.php.net/license/3_0.txt.                                  |
| If you did not receive a copy of the PHP license and are unable to   |
| obtain it through the world-wide-web, please send a note to          |
| license@php.net so we can mail you a copy immediately.               |
+----------------------------------------------------------------------+
| Authors:          Maciej Sobaczewski <sobak@php.net>                 |
+----------------------------------------------------------------------+
*/

header('Content-type: text/plain');

require_once('../build-ops.php');

$filename = ltrim($_GET['filename'], '/'); // @fixme sanitization
$r1 = preg_match('/^[0-9a-fA-F]+$/', $_GET['r1']) ? $_GET['r1'] : null;
$r2 = preg_match('/^[0-9a-fA-F]+$/', $_GET['r2']) ? $_GET['r2'] : null;

if (!isset($filename, $r1, $r2)) {
    exit('Invalid parameters');
}

@chdir(SVN_DIR . DOC_DIR . 'en');
exec(GIT_BIN . " diff $r1 $r2 -- $filename", $output, $code);

if ($code !== 0) {
    exit('An error ocurred');
}

foreach ($output as $line) {
    echo $line . "\n";
}
