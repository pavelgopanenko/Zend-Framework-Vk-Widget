<?php
/**
 * Like VK widget helper.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @link       https://github.com/pavelgopanenko/Zend-Framework-Vk-Widget/wiki/Like
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 * @see        http://vkontakte.ru/developers.php?o=-1&p=%C4%EE%EA%F3%EC%E5%ED%F2%E0%F6%E8%FF+%EA+%E2%E8%E4%E6%E5%F2%F3+%CC%ED%E5+%ED%F0%E0%E2%E8%F2%F1%FF
 */
class Ulrika_View_Helper_Vk_VkLike extends Ulrika_View_Helper_Vk_Abstract
{
    /**
     * Display widget type flag, allow: "button", "mini", "vertical" or "full".
     * @var string
     */
    protected $_type = 'full';

    /**
     * Widget width.
     * @var mixed
     */
    protected $_width = 200;

    /**
     * Displaying title on user wall.
     * @var string
     */
    protected $_pageTitle;

    /**
     * Displaying description text on user wall.
     * @var string
     */
    protected $_pageDescription;

    /**
     * Page URL on user wall.
     * @var string
     */
    protected $_pageUrl;

    /**
     * Page illustration image on user wall.
     * @var string
     */
    protected $_pageImage;

    /**
     * Vrbal variant flag.
     * @var boolena
     */
    protected $_verb = false;

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
        $options = array('type'  => $this->_type,
                         'width' => $this->_width < 200 ? 200 : $this->_width,
                         'verb'  => (int) $this->_verb);

        if (null !== $this->_pageTitle) {
            $options['pageTitle'] = $this->_pageTitle;
        }
        if (null !== $this->_pageDescription) {
            $options['pageDescription'] = $this->_pageDescription;
        }
        if (null !== $this->_pageUrl) {
            $options['pageUrl'] = $this->_pageUrl;
        }
        if (null !== $this->_pageImage) {
            $options['pageImage'] = $this->_pageImage;
        }
        if (null !== $this->_pageId) {
            $options['pageId'] = $this->_pageId;
        }

        $template = $this->_pageId ? 'VK.Widgets.Like("%s", %s, "%s");' : 'VK.Widgets.Like("%s", %s);';
        $js = sprintf($template, $element, self::_arrayToJsObject($options), $this->_pageId);

         return $js;
    }

    /**
     * Init widget.
     * @param int $groupId Owner group identity
     * @return Ulrika_View_Helper_Vk_VkLike
     */
    public function vkLike()
    {
        $this->_addOpenApiScript();

        return $this;
    }
}
