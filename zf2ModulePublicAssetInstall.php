<?php
/**
 * ZF2 Module Public Asset Installer
 *
 * This PHP CLI script allows ZF2 modules to have routable public asset
 * folders. Urls like /vendor/RodsZf2Module/css/style.css will map to
 * /vendor/rod/RodsZf2Module/public/css/style.css This script must run from
 * your ZF2 project root folder. This script is similar to the Symfony 2
 * command "php app/console assets:install"
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @author    Rod McNew <rodmcnew@gmail.com>
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

// ZF2 project root folder that contains public, module, vendor, etc.
$projectRootDir = __DIR__;

// Path where the symlinks will be written
$publicLinkHome = $projectRootDir . '/public/modules/';

if (!file_exists($publicLinkHome)) {

    //Create the public/modules directory if it does not already exist
    echo "Creating directory $publicLinkHome\n";
    mkdir($publicLinkHome);

    //Add a .gitignore file to the modules directory
    $gitIgnorePath = $publicLinkHome . '.gitignore';
    echo "Creating file $gitIgnorePath\n";
    file_put_contents($gitIgnorePath, '*');
}

// Find all Module.php files in order to locate all ZF2 modules.
$modulePhpFiles = new RegexIterator(
    new RecursiveIteratorIterator(
        New RecursiveDirectoryIterator($projectRootDir)
    ),
    '/^.+Module.php$/i',
    RecursiveRegexIterator::GET_MATCH
);

// Add a symlink to the main public directory for each ZF2 module that has a
// public directory
foreach ($modulePhpFiles as $modulePhpFilePath) {

    // Module's main folder
    $modulePath = realpath(dirname($modulePhpFilePath[0]));
    
    // Module's public folder
    $modulePublicPath = $modulePath . '/public';

    // Module's CamelCase name
    $moduleName = basename($modulePath);

    // Check if this module has a public folder
    if (is_dir($modulePublicPath)) {
        
        // Path where the symlink will be written. lower-case-hyphens are
        // used because this path will end up in URLs
        $symlinkPath = $publicLinkHome . camelToHyphens($moduleName);

        // Ensure symlink doesn't already exist
        if (!is_link($symlinkPath)) {

            // Create the symlink
            echo "Creating symlink\n    From: $symlinkPath\n"
                . "    To: $modulePublicPath\n";
            symlink($modulePublicPath, $symlinkPath);

        }
    }

}

/*
 * Converts CamelCase to lower-case-hyphens
 *
 * @param string $value the value to convert
 *
 * @return string
 */
function camelToHyphens($value)
{
    return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $value));
}
