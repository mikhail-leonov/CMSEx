<?php
/**
 * Include section
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
     *
     * @return void
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
     *
     * @return void
     */
    public function unselect_tag()
    {
        $tag = Util::GetAttribute($_GET, 'tag', array());
        foreach ($tag as $name => $value) {
            unset($_COOKIE[ "tag" ][$name]);
            Cookie::setCookie("tag[$name]", false, - Cookie::YEAR);
        }
    }

    /**
     * add_tag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function add_tag($params)
    {
        $tag_id   = Util::GetAttribute($params, 'tag_id', 0);
        $entry_id = Util::GetAttribute($params, 'entry_id', 0);
        if (!empty($tag_id)) {
            if (!empty($entry_id)) {
                $fields = array( "tag_id" => $tag_id, "entry_id" => $entry_id );
                $this->db->insert($fields)->into("entries_tags")->exec();
            }
        }
    }

    /**
     * del_tag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function del_tag($params)
    {
        $tag_id   = Util::GetAttribute($params, 'tag_id', 0);
        $entry_id = Util::GetAttribute($params, 'entry_id', 0);
        if (!empty($tag_id)) {
            if (!empty($entry_id)) {
                $where = array( "tag_id" => $tag_id, "entry_id" => $entry_id );
                $this->db->delete()->from("entries_tags")->where($where)->exec();
            }
        }
    }

    /**
     * new_tag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function new_tag($params)
    {
        $result = 0;

        $tag_name     = Util::GetAttribute($params, 'tag_name', '');
        $tag_group_id = Util::GetAttribute($params, 'tag_group_id', 0);

        if (!empty($tag_name)) {
            if (!empty($tag_group_id)) {
                $fields = array( "tag_name" => $tag_name, "tag_text" => $tag_name, "tag_group_id" => $tag_group_id );
                $this->db->insert($fields)->into("tags")->exec();
                $result = 1;
            }
        }
        return $result;
    }
}
