<?php
/**
 * Executes a shell command over and over and prints how long it took
 *
 * @author    Rod Mcnew
 * @license   License.txt New BSD License
 */
$command = 'curl https://base.reliv.com -s';
echo $command . "\n";
$i = 0;
while (true) {
    $startTime = microtime(true);
    $i++;
    exec($command);
    echo $i . ") " . number_format(
            (microtime(true) - $startTime)
            * 1000,
            1
        ) . "ms\n";
}