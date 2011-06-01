<?php
/**
 * Donate VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Donate
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/developers.php?o=-1&p=Donate
 */
class Ulrika_View_Helper_Vk_VkDonate extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Widget width.
     * @var int
     */
    protected $_width = 300;

    /**
     * Display mode flag: false - compact, true - details
     * @var boolean
     */
    protected $_mode = false;

    /**
     * Group identity.
     * @var int
     */
    protected $_groupId;

    /**
     * (non-PHPdoc)
     * @see Ulrika_View_Helper_Vk_Abstract::_builtWidget()
     */
    protected function _builtWidget($element)
    {
        $options = array('mode'  => (int) $this->_mode,
                         'width' => $this->_width < 300 ? 300 : $this->_width);

        $js = sprintf('VK.Widgets.Donate("%s", %s, %d);', $element, self::_arrayToJsObject($options), $this->_groupId);

         return $js;
    }

    /**
     * Init widget.
     * @param int $groupId Owner group identity
     * @return Ulrika_View_Helper_Vk_VkDonate
     */
    public function vkDonate($groupId)
    {
        $this->_groupId = $groupId;

        $this->_addOpenApiScript(false);

        return $this;
    }
}
