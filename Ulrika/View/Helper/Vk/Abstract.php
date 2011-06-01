<?php
/**
 * Abstract VK widget helper.
 *
 * The base implementation of the widget,
 * provides methods to generate html and js code.
 *
 * @category   Ulrika
 * @package    Ulrika_View
 * @subpackage Ulrika_View_Helper_Vk
 *
 * @author     Pavel Gopanenko <pavelgopanenko@gmail.com>
 * @license    FreeBSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 1.0.0
 */
abstract class Ulrika_View_Helper_Vk_Abstract extends Zend_View_Helper_Abstract
{
    private static $_hasAddInitScript = false;

    private static $_appId;

    /**
     * Set application identity.
     * @param int $appId
     */
    public static function setAppId($appId)
    {
        self::$_appId = $appId;
    }

    /**
     * Return application identity.
     * @throws \RuntimeException Throw exception if identity not recognized.
     */
    public static function getAppId()
    {
        if (null !== self::$_appId)
            return self::$_appId;

        if (Zend_Registry::isRegistered('Ulrika_Vk_Api_AppId')) {
            $appId = Zend_Registry::get('Ulrika_Vk_Api_AppId');
        } else {
            throw new \RuntimeException('VK application id not recognized. Use "Zend_Registry" with "Ulrika_Vk_Api_AppId" key.');
        }

        return self::$_appId = $appId;
    }

    /**
     * Translate PHP array to JS object string notation.
     * @param array $params
     * @return string
     */
    protected static function _arrayToJsObject(array $params)
    {
        $result = array();

        foreach ($params as $field => $value) {

            if (is_string($value)) {
                $strlen = mb_strlen($value, 'utf-8');
                // TODO оптимизировать работу с типом "функция", избавиться от шаблоона <%...%>
                if (strpos($value, '<%') === 0 && strpos($value, '%>') === $strlen - 2) {
                    $value = trim(mb_substr($value, 2, $strlen - 4));
                } else {
                    $value = '"' . $value . '"';
                }
            } elseif (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $result[] = $field . ': ' . $value;
        }

        return '{' . implode(', ', $result) . '}';
    }

    private $_result = '';

    private function getDefaultContainerName()
    {
        return 'vk_' . $this->getWidgetName();
    }

    /**
     * The method should assemble widget JS code.
     * @param string $element HTML-container element id
     * @return string
     */
    abstract protected function _builtWidget($element);

    /**
     * Append header Open API script.
     * @param boolean $appInit Add init command flag.
     * @param boolean $onlyWidgets Add "onlyWidgets" flag to init command.
     */
    final protected function _addOpenApiScript($appInit = true, $onlyWidgets = true)
    {
        if (self::$_hasAddInitScript)
            return;

        $headScript = $this->view->headScript();
        $headScript->appendFile('http://userapi.com/js/api/openapi.js', 'text/javascript', array('charset' => 'windows-1251'));

        if ($appInit) {
            $headScript->appendScript("VK.init({apiId: '" . self::getAppId() . "', onlyWidgets: " . ($onlyWidgets ? 'true' : 'false') . "});");
            self::$_hasAddInitScript = true;
        }
    }

    /**
     * Return short widget name.
     * @return string
     */
    public function getWidgetName()
    {
        return lcfirst(str_replace('Ulrika_View_Helper_Vk_Vk', '', get_class($this)));
    }

    /**
     * Append HTML-container tag.
     * @return Ulrika_View_Helper_Vk_Abstract
     */
    public function container()
    {
        $this->_result .= '<div id="' . $this->getDefaultContainerName() .  '"></div>' . PHP_EOL;

        return $this;
    }

    /**
     * Append widget initialization script.
     * @param string $element Element container id. If no parameter, an identifier is used by default.
     * @return Ulrika_View_Helper_Vk_Abstract
     */
    public function widget($element = null)
    {
        $element = $element ? $element : $this->getDefaultContainerName();

        $this->_result .= '<script type="text/javascript">' . $this->_builtWidget($element) . '</script>' . PHP_EOL;
        return $this;
    }

    public function __toString()
    {
        return $this->_result;
    }

    public function __call($method, $args)
    {
        $property = '_' . $method;
        if (property_exists($this, $property) && $property != '_result') {
            $this->{$property} = isset($args[0]) ? $args[0] : null;
            return $this;
        }

        throw new \RuntimeException("Method \"$method\" not recognized.");
    }
}
