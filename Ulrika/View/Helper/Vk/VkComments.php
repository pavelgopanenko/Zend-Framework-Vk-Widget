<?php
/**
 * Comments VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Comments
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/developers.php?o=-1&p=Comments
 */
class Ulrika_View_Helper_Vk_VkComments extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Limit posts per page.
     * @var int
     */
    protected $_limit = 10;

    /**
     * Widget width.
     * @var int
     */
    protected $_width = 600;

    /**
     * Height width.
     * @var int
     */
    protected $_height = 0;

    /**
     * Allow attach type flag, supported: "graffiti", "photo", "audio", "video", "link" and "*" for all, false - disabled attach.
     * @var mixed
     */
    protected $_attach = '*';

    /**
     * Auto publication flag.
     * @var boolean
     */
    protected $_autoPublish = true;

    /**
     * Realtime update widget content flag.
     * @var boolean
     */
    protected $_norealtime = false;

    /**
     * Change handler JS function name.
     * @var string
     */
    protected $_onChange;

    /**
     * Status translation page link.
     * @var string
     */
    protected $_pageUrl;

    /**
     * Owner page id.
     * @var int
     */
    protected $_pageId;

    /**
     * (non-PHPdoc)
     * @see Ulrika_View_Helper_Vk_Abstract::_builtWidget()
     */
    protected function _builtWidget($element)
    {
        if ($this->_limit < 5)
            $this->_limit = 5;
        if ($this->_limit > 100)
            $this->_limit = 100;

        $options = array('limit'  => $this->_limit,
                         'width'  => $this->_width < 300 ? 300 : $this->_width,
        				 'attach' => $this->_attach,
                         'autoPublish' => (int) $this->_autoPublish);

        if (null !== $this->_onChange) {
            $options['onChange'] = '<%' . $this->_onChange . '%>';
        }
        if (null !== $this->_pageUrl) {
            $options['pageUrl'] = $this->_pageUrl;
        }
        if ($this->_norealtime) {
            $options['norealtime'] = (int) $this->_norealtime;
        }
        if ($this->_height > 0) {
            $options['height'] = $this->_height < 500 ? 500 : $this->_height;
        }

        $template = $this->_pageId ? 'VK.Widgets.Comments("%s", %s, "%s");' : 'VK.Widgets.Comments("%s", %s);';
        $js = sprintf($template, $element, self::_arrayToJsObject($options), $this->_pageId);

         return $js;
    }

    /**
     * Init widget.
     * @return Ulrika_View_Helper_Vk_VkComments
     */
    public function vkComments()
    {
        $this->_addOpenApiScript();

        return $this;
    }
}
