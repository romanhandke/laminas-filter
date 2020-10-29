<?php

/**
 * @see       https://github.com/laminas/laminas-filter for the canonical source repository
 * @copyright https://github.com/laminas/laminas-filter/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-filter/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Filter;

use Laminas\Filter\Callback as CallbackFilter;

/**
 * @group      Zend_Filter
 */
class CallbackTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectCallback()
    {
        $filter = new CallbackFilter(array($this, 'objectCallback'));
        $this->assertEquals('objectCallback-test', $filter('test'));
    }

    public function testConstructorWithOptions()
    {
        $filter = new CallbackFilter(array(
            'callback'        => array($this, 'objectCallbackWithParams'),
            'callback_params' => 0,
        ));

        $this->assertEquals('objectCallbackWithParams-test-0', $filter('test'));
    }

    public function testStaticCallback()
    {
        $filter = new CallbackFilter(
            array(__CLASS__, 'staticCallback')
        );
        $this->assertEquals('staticCallback-test', $filter('test'));
    }

    public function testSettingDefaultOptions()
    {
        $filter = new CallbackFilter(array($this, 'objectCallback'), 'param');
        $this->assertEquals(array('param'), $filter->getCallbackParams());
        $this->assertEquals('objectCallback-test', $filter('test'));
    }

    public function testSettingDefaultOptionsAfterwards()
    {
        $filter = new CallbackFilter(array($this, 'objectCallback'));
        $filter->setCallbackParams('param');
        $this->assertEquals(array('param'), $filter->getCallbackParams());
        $this->assertEquals('objectCallback-test', $filter('test'));
    }

    public function testCallbackWithStringParameter()
    {
        $filter = new CallbackFilter('strrev');
        $this->assertEquals('!olleH', $filter('Hello!'));
    }

    public function testCallbackWithArrayParameters()
    {
        $filter = new CallbackFilter('strrev');
        $this->assertEquals('!olleH', $filter('Hello!'));
    }

    public function objectCallback($value)
    {
        return 'objectCallback-' . $value;
    }

    public static function staticCallback($value)
    {
        return 'staticCallback-' . $value;
    }

    public function objectCallbackWithParams($value, $param = null)
    {
        return 'objectCallbackWithParams-' . $value . '-' . $param;
    }
}
