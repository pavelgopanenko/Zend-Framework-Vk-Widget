<?php

class Ulrika_View_Helper_Vk_VkPollTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkPoll();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkPoll()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkPoll', $helper->vkPoll(123));
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('poll', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_poll"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $helper = $this->_helper->vkPoll(123);
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Poll("test", {width: 300}, "123");</script>' . PHP_EOL, (string) $helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
