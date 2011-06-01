<?php
/**
 * Recommendation VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Recommended
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/pages.php?o=-1&p=Recommended
 */
class Ulrika_View_Helper_Vk_VkRecommended extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Displayed page number.
     * @var int
     */
    protected $_limit = 5;

    /**
     * Verbal variant flag.
     * @var boolean
     */
    protected $_verb = false;

    /**
     * Recommendation update period, allow: "day", "week" or "month".
     * @var strong
     */
    protected $_period = 'week';

    /**
     * Value of "taget" link attribute, allow: "blank", "top" or "parrent".
     * @var unknown_type
     */
    protected $_target = 'parent';

    /**
     * Max page count.
     * @var int
     */
    protected $_max;

    /**
     * (non-PHPdoc)
     * @see Ulrika_View_Helper_Vk_Abstract::_builtWidget()
     */
    protected function _builtWidget($element)
    {
        $options = array('limit' =>  $this->_limit,
                         'verb'  =>  (int) $this->_verb,
                         'period' => $this->_period,
                         'target' => $this->_target);

        if (null !== $this->_max) {
            $options['max'] = $this->_max;
        }

        $js = sprintf('VK.Widgets.Recommended("%s", %s);', $element, self::_arrayToJsObject($options));
        return $js;
    }

    /**
     * Init widget.
     * @return Ulrika_View_Helper_Vk_VkRecommended
     */
    public function vkRecommended()
    {
        $this->_addOpenApiScript();

        return $this;
    }
}
