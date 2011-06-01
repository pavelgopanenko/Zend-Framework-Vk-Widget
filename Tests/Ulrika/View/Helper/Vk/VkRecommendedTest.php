<?php

class Ulrika_View_Helper_Vk_VkRecommendedTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkRecommended();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkPoll()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkRecommended', $helper->vkRecommended());
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('recommended', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_recommended"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Recommended("test", {limit: 5, verb: 0, period: "week", target: "parent"});</script>' . PHP_EOL, (string) $this->_helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
