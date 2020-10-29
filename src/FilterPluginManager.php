<?php

/**
 * @see       https://github.com/laminas/laminas-filter for the canonical source repository
 * @copyright https://github.com/laminas/laminas-filter/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-filter/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Filter;

use Laminas\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for the filter chain.
 *
 * Enforces that filters retrieved are either callbacks or instances of
 * FilterInterface. Additionally, it registers a number of default filters
 * available, as well as aliases for them.
 */
class FilterPluginManager extends AbstractPluginManager
{
    /**
     * Default set of plugins factories
     *
     * @var array
     */
    protected $factories = array(
        'wordseparatortoseparator' => 'Laminas\Filter\Word\Service\SeparatorToSeparatorFactory',
    );

    /**
     * Default set of filters
     *
     * @var array
     */
    protected $invokableClasses = array(
        'alnum'                      => 'Laminas\I18n\Filter\Alnum',
        'alpha'                      => 'Laminas\I18n\Filter\Alpha',
        'basename'                   => 'Laminas\Filter\BaseName',
        'boolean'                    => 'Laminas\Filter\Boolean',
        'callback'                   => 'Laminas\Filter\Callback',
        'compress'                   => 'Laminas\Filter\Compress',
        'compressbz2'                => 'Laminas\Filter\Compress\Bz2',
        'compressgz'                 => 'Laminas\Filter\Compress\Gz',
        'compresslzf'                => 'Laminas\Filter\Compress\Lzf',
        'compressrar'                => 'Laminas\Filter\Compress\Rar',
        'compresssnappy'             => 'Laminas\Filter\Compress\Snappy',
        'compresstar'                => 'Laminas\Filter\Compress\Tar',
        'compresszip'                => 'Laminas\Filter\Compress\Zip',
        'datetimeformatter'          => 'Laminas\Filter\DateTimeFormatter',
        'decompress'                 => 'Laminas\Filter\Decompress',
        'decrypt'                    => 'Laminas\Filter\Decrypt',
        'digits'                     => 'Laminas\Filter\Digits',
        'dir'                        => 'Laminas\Filter\Dir',
        'encrypt'                    => 'Laminas\Filter\Encrypt',
        'encryptblockcipher'         => 'Laminas\Filter\Encrypt\BlockCipher',
        'encryptopenssl'             => 'Laminas\Filter\Encrypt\Openssl',
        'filedecrypt'                => 'Laminas\Filter\File\Decrypt',
        'fileencrypt'                => 'Laminas\Filter\File\Encrypt',
        'filelowercase'              => 'Laminas\Filter\File\LowerCase',
        'filerename'                 => 'Laminas\Filter\File\Rename',
        'filerenameupload'           => 'Laminas\Filter\File\RenameUpload',
        'fileuppercase'              => 'Laminas\Filter\File\UpperCase',
        'htmlentities'               => 'Laminas\Filter\HtmlEntities',
        'inflector'                  => 'Laminas\Filter\Inflector',
        'int'                        => 'Laminas\Filter\Int',
        'null'                       => 'Laminas\Filter\Null',
        'numberformat'               => 'Laminas\I18n\Filter\NumberFormat',
        'numberparse'                => 'Laminas\I18n\Filter\NumberParse',
        'pregreplace'                => 'Laminas\Filter\PregReplace',
        'realpath'                   => 'Laminas\Filter\RealPath',
        'stringtolower'              => 'Laminas\Filter\StringToLower',
        'stringtoupper'              => 'Laminas\Filter\StringToUpper',
        'stringtrim'                 => 'Laminas\Filter\StringTrim',
        'stripnewlines'              => 'Laminas\Filter\StripNewlines',
        'striptags'                  => 'Laminas\Filter\StripTags',
        'urinormalize'               => 'Laminas\Filter\UriNormalize',
        'wordcamelcasetodash'        => 'Laminas\Filter\Word\CamelCaseToDash',
        'wordcamelcasetoseparator'   => 'Laminas\Filter\Word\CamelCaseToSeparator',
        'wordcamelcasetounderscore'  => 'Laminas\Filter\Word\CamelCaseToUnderscore',
        'worddashtocamelcase'        => 'Laminas\Filter\Word\DashToCamelCase',
        'worddashtoseparator'        => 'Laminas\Filter\Word\DashToSeparator',
        'worddashtounderscore'       => 'Laminas\Filter\Word\DashToUnderscore',
        'wordseparatortocamelcase'   => 'Laminas\Filter\Word\SeparatorToCamelCase',
        'wordseparatortodash'        => 'Laminas\Filter\Word\SeparatorToDash',
        'wordunderscoretocamelcase'  => 'Laminas\Filter\Word\UnderscoreToCamelCase',
        'wordunderscoretostudlycase' => 'Laminas\Filter\Word\UnderscoreToStudlyCase',
        'wordunderscoretodash'       => 'Laminas\Filter\Word\UnderscoreToDash',
        'wordunderscoretoseparator'  => 'Laminas\Filter\Word\UnderscoreToSeparator',
    );

    /**
     * Whether or not to share by default; default to false
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof FilterInterface) {
            // we're okay
            return;
        }
        if (is_callable($plugin)) {
            // also okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\FilterInterface or be callable',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
