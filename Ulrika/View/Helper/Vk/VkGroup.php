<?php
/**
 * Group VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Group
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/developers.php?o=-1&p=Group
 */
class Ulrika_View_Helper_Vk_VkGroup extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Widget width, auto - stretch to container width.
     * @var mixed
     */
    protected $_width = 'auto';

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
     * Group identity.
     * @var int
     */
    protected function _builtWidget($element)
    {
        if (is_numeric($this->_width) && $this->_width < 300) {
            $this->_width = 300;
        }

        $options = array('mode'  => (int) $this->_mode,
                         'width' => $this->_width);

        $js = sprintf('VK.Widgets.Group("%s", %s, %d);', $element, self::_arrayToJsObject($options), $this->_groupId);

         return $js;
    }

    /**
     * Init widget.
     * @param int $groupId Owner group identity
     * @return Ulrika_View_Helper_Vk_VkGroup
     */
    public function vkGroup($groupId)
    {
        $this->_groupId = $groupId;

        $this->_addOpenApiScript(false);

        return $this;
    }
}
