<?php

class Ulrika_View_Helper_Vk_VkLikeTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkLike();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkLike()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkLike', $helper->vkLike());
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('like', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_like"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Like("test", {type: "full", width: 200, verb: 0});</script>' . PHP_EOL, (string) $this->_helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
