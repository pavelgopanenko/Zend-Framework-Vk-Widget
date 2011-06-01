<?php
/**
 * Poll VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Poll
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/pages.php?o=-1&p=Poll
 */
class Ulrika_View_Helper_Vk_VkPoll extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Widget width.
     * @var int
     */
    protected $_width = 300;

    /**
     * Poll page URL, set if poll result may see on another page.
     * @var unknown_type
     */
    protected $_pageUrl;

    /**
     * Created poll identity.
     * @var string
     */
    protected $_pollId;

    /**
     * (non-PHPdoc)
     * @see Ulrika_View_Helper_Vk_Abstract::_builtWidget()
     */
    protected function _builtWidget($element)
    {
        $options = array('width' => $this->_width < 200 ? 200 : $this->_width);

        if ($this->_pageUrl)
            $options['pageUrl'] = $this->_pageUrl;

        $js = sprintf('VK.Widgets.Poll("%s", %s, "%s");', $element, self::_arrayToJsObject($options), $this->_pollId);

         return $js;
    }

    /**
     * Init widget.
     * @param string $pollId Poll identity
     * @return Ulrika_View_Helper_Vk_VkPoll
     */
    public function vkPoll($pollId)
    {
        $this->_pollId = $pollId;

        $this->_addOpenApiScript(true, false);

        return $this;
    }
}
