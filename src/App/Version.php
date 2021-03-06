<?php
namespace phpbu\App;

use SebastianBergmann;

/**
 * Cli argument parser.
 *
 * @package    phpbu
 * @subpackage App
 * @author     Sebastian Bergamann <sebastian@phpunit.de>
 * @author     Sebastian Feldmann <sebastian@phpbu.de>
 * @copyright  Sebastian Feldmann <sebastian@phpbu.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://phpbu.de/
 * @since      Class available since Release 1.0.0
 */
class Version
{
    /**
     * Version of the phar file.
     * Is getting set via the phar build process.
     *
     * @var string
     */
    private static $pharVersion;

    /**
     * Current version
     *
     * @var string
     */
    private static $version;

    /**
     * Return the current version of PHPUnit.
     *
     * @return string
     */
    public static function id()
    {
        if (self::$pharVersion !== null) {
            return self::$pharVersion;
        }

        if (self::$version === null) {
            $version = new SebastianBergmann\Version('1.1', dirname(dirname(__DIR__)));
            self::$version = $version->getVersion();
        }

        return self::$version;
    }

    /**
     * Return the version string.
     *
     * @return string
     */
    public static function getVersionString()
    {
        return 'phpbu ' . self::id();
    }

    /**
     * Return the current release channel ('alpha', 'beta', '')
     *
     * @return string
     */
    public static function getReleaseChannel()
    {
        if (strpos(self::$pharVersion, 'alpha') !== false) {
            return '-alpha';
        }

        if (strpos(self::$pharVersion, 'beta') !== false) {
            return '-beta';
        }

        return '';
    }
}
