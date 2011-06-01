<?php

class Ulrika_View_Helper_Vk_VkCommentsTest extends PHPUnit_Framework_TestCase
{
    private $_helper;

    public function setUp()
    {
        $helper = new Ulrika_View_Helper_Vk_VkComments();
        $helper->setView(new Zend_View());
        $helper->setAppId(123);

        $this->_helper = $helper;
    }

    public function testVkComments()
    {
        $helper = $this->_helper;

        $this->assertInstanceOf('Ulrika_View_Helper_Vk_VkComments', $helper->vkComments());
    }

    public function testGetWidgetName()
    {
        $this->assertEquals('comments', $this->_helper->getWidgetName());
    }

    public function testContainer()
    {
        $this->assertEquals('<div id="vk_comments"></div>' . PHP_EOL, (string) $this->_helper->container());
    }

    public function testWidget()
    {
        $this->assertEquals('<script type="text/javascript">VK.Widgets.Comments("test", {limit: 10, width: 600, attach: "*", autoPublish: 1});</script>' . PHP_EOL, (string) $this->_helper->widget('test'));
    }

    public function tearDown()
    {
        unset($this->helper);
    }
}
