<?php
/**
 * Abstract controller
 */
require_once(MODEL . 'abstract.model.php');
require_once(LIB . 'cookie.class.php ');

/**
 * API Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiModel extends AbstractModel
{
    /**
     * select_tag
     */
    public function select_tag()
    {
        $tag = Util::GetAttribute($_GET, 'tag', array());
        foreach ($tag as $name => $value) {
            Cookie::setCookieFOREVER("tag[$name]", $value);
        }
    }
    /**
     * unselect_tag
     */
    public function unselect_tag()
    {
        $tag = Util::GetAttribute($_GET, 'tag', array());
        foreach ($tag as $name => $value) {
            unset($_COOKIE[ "tag" ][$name]);
            Cookie::setCookie("tag[$name]", false, - Cookie::YEAR);
        }
    }
}
