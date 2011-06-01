<?php

class Ulrika_View_Helper_Vk_VkGroupTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkGroup();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkGroup()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkGroup', $helper->vkGroup(123));
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('group', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_group"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $helper = $this->_helper->vkGroup(123);
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Group("test", {mode: 0, width: "auto"}, 123);</script>' . PHP_EOL, (string) $helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
