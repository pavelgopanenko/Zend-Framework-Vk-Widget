<?php
/**
 * Authentication VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Auth
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/developers.php?o=-1&p=Auth
 */
class Ulrika_View_Helper_Vk_VkAuth extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Widget width.
     * @var int
     */
    protected $_width = 300;

    /**
     * Success auth handler function name.
     * @var string
     */
    protected $_onAuth;

    /**
     * Success auth redirect URL.
     * @var string
     */
    protected $_authUrl;

    /**
     * (non-PHPdoc)
     * @see Ulrika_View_Helper_Vk_Abstract::_builtWidget()
     */
    protected function _builtWidget($element)
    {
        $options = array('width' => $this->_width < 200 ? 200 : $this->_width);

        if ($this->_authUrl) {
            $options['authUrl'] = $this->_authUrl;
        }
        if ($this->_onAuth) {
            $options['onAuth'] = '<%' . $this->_onAuth . '%>';
        }

        $js = sprintf('VK.Widgets.Auth("%s", %s);', $element, self::_arrayToJsObject($options));

         return $js;
    }

    /**
     * Init widget.
     * @return Ulrika_View_Helper_Vk_VkAuth
     */
    public function vkAuth()
    {
        $this->_addOpenApiScript();

        return $this;
    }
}
