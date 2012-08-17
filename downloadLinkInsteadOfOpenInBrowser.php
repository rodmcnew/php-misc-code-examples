<?php
/**
 * Force download of link rather than open in browser. (example: mp3s)
 *
 * This script forces a file to open as a download link rather than
 * opening in the browser. To use this, just change $file below to the path to
 * the file you want your link to download (relative to the folder this php file
 * is in). Then point your html link to this php file.
 *
 * For simplicity, this only works on a single file but could be expanded to
 * read the file name from $_GET and use a file-name white list to securely
 * handle multiple files.
 *
 * PHP version 5.3
 *
 * @author    Rod McNew <rodmcnew@gmail.com>
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

//Path to the file we want the browser to download
$file = __DIR__ . '../../mp3s/whatever.mp3';

//Tell browser we are outputting a binary file
header('Content-type: octet/stream');

//Tell browser to download it instead of opening it
header('Content-disposition: attachment; filename=' . $file . ';');

//Tell the browser the size of the file
header('Content-Length: ' . filesize($file));

//Give the browser the file
readfile($file);

//Stop running php so no whitespace gets echoed into the file
exit;
