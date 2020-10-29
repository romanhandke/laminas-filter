<?php

/**
 * @see       https://github.com/laminas/laminas-filter for the canonical source repository
 * @copyright https://github.com/laminas/laminas-filter/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-filter/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Filter\Word;

use ReflectionProperty;
use Laminas\Stdlib\StringUtils;

/**
 * Test class for Laminas\Filter\Word\CamelCaseToSeparator which simulates the
 * PCRE Unicode features disabled
 */
class CamelCaseToSeparatorNoPcreUnicodeTest extends CamelCaseToSeparatorTest
{
    protected $reflection;

    public function setUp()
    {
        if (!StringUtils::hasPcreUnicodeSupport()) {
            return $this->markTestSkipped('PCRE is not compiled with Unicode support');
        }

        $this->reflection = new ReflectionProperty('Laminas\Stdlib\StringUtils', 'hasPcreUnicodeSupport');
        $this->reflection->setAccessible(true);
        $this->reflection->setValue(false);
    }

    public function tearDown()
    {
        $this->reflection->setValue(true);
    }
}
