<?php
/**
 * Include section
 */
require_once(MODEL . 'abstract.model.php');

/**
 * Recipe Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class RecipeModel extends AbstractModel
{
    /**
     * Get all selected recepies
     *
     * @return array All entries matched to selected Tags
     */
    public function GetRecipies() : array
    {
        $result = [];
        $selectedTags = Util::GetAlreadySelected("tag");
        if (count($selectedTags) > 0) {
            $sqls = [];
            foreach ($selectedTags as $k => $tag) {
                $tag_id = Util::GetAttribute($tag, 'tag_id', "");
                if ($k == 0) {
                    $select = "SELECT sub0.entry_id as entry_id FROM entries_tags as sub{$k}";
                    $where = "tag_id = '{$tag_id}'";
                }
                if ($k  > 0) {
                    $sqls[] = "INNER JOIN ( SELECT DISTINCT entry_id FROM entries_tags WHERE tag_id = '{$tag_id}' ) sub{$k} ON ( sub0.entry_id = sub{$k}.entry_id )";
                }
            }
        
            $joins = implode("\n", $sqls);
            $sql = "{$select} {$joins} WHERE {$where}";
        
            $ids = $this->db->sql($sql)->all();
        
            $selectedIds = "";
            $splitter = "";
            foreach ($ids as $k => $entryId) {
                $id = Util::GetAttribute($entryId, 'entry_id', 0);
                $selectedIds .= "{$splitter}{$id}";
                $splitter=",";
            }
            $result = $this->db->select("*")->from("entries")->where("entry_id in ($selectedIds)")->all();
        }
        return $result;
    }

    /**
     * Get all selected/grouped niot selected tags from tags Table
     *
     * @var array $params Parameters
     *
     * @return array All entries matched to selected Tags
     */
    public function SearchRecipies(array $params) : array
    {
        $result = [];
        $q = Util::GetAttribute($params, 'q', '');
        if (!empty($q)) {
            $where = array("entry_name LIKE '%{$q}%' OR entry_text LIKE '%{$q}%'");
            $result = $this->db->select("*")->from("entries")->where($where)->all();
        }
        return $result;
    }
}
