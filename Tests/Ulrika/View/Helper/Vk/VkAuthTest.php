<?php

class Ulrika_View_Helper_Vk_VkAuthTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkAuth();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkAuth()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkAuth', $helper->vkAuth());
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('auth', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_auth"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Auth("test", {width: 300});</script>' . PHP_EOL, (string) $this->_helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
