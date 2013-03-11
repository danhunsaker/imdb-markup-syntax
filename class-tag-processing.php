<?php

namespace IMDb_Markup_Syntax;

use IMDb;
use IMDb_Markup_Syntax\Exceptions\PCRE_Exception;

require_once dirname(__FILE__) . '/Exceptions/class-pcre-exception.php';

/**
 * Find and replace imdb tags to movie data from IMDb
 * @author Henrik Roos <henrik at afternoon.se>
 * @package Core
 */
class Tag_Processing {

    /** @var string regular expression for find id */
    public $id_pattern = "/\[imdb\:id\((tt\d+)\)\]/i";

    /** @var string regular expression for all imdb tags */
    public $imdb_tags_pattern = "/\[imdb\:([a-z0-9]+)\]/i";

    /** @var string Original content before this filter processing */
    public $original_content;

    /**
     * @var string Id on current movie. <i>e.g http://www.imdb.com/title/tt0137523/ -> id = tt0137523</i>
     * Syntax: <b>[imdb:id(ttxxxxxxx)]</b>
     */
    public $id;

    /** @var IMDb object IMDb:s data object */
    public $data;

    /** @var array of imdb tags. All imdb tags in current content */
    public $imdb_tags = array();

    /**
     * Create an object
     * @param string $original_content
     */
    public function __construct($original_content) {
        $this->original_content = $original_content;
    }

    /**
     * Find and store it in $id. Syntax: <b>[imdb:id(ttxxxxxxx)]</b>.
     * <i>e.g. "Nunc non diam sit [imdb:id(tt0137523)] nulla sem tempus magna" -> id = tt0137523</i>
     * @return boolean FALSE if no match TRUE if find a id
     * @throws PCRE_Exception if a PCRE error occurs or patten compilation failed
     */
    public function find_id() {
        $matches = array();
        if (@preg_match($this->id_pattern, $this->original_content, $matches) === FALSE) {
            throw new PCRE_Exception();
        }
        if (empty($matches)) {
            $this->id = null;
            return FALSE;
        }
        $this->id = $matches[1];
        return TRUE;
    }

    /**
     * Find and store alltags in imdb_tags array. Syntax: <b>[imdb:xxx]</b> 
     * @return boolean FALSE if no match TRUE if find 
     * @throws PCRE_Exception if a PCRE error occurs or patten compilation failed
     */
    public function find_imdb_tags() {
        $matches = array();
        if (@preg_match_all($this->imdb_tags_pattern, $this->original_content, $matches) === FALSE) {
            throw new PCRE_Exception();
        }
        $this->imdb_tags = $matches[1];
        return !empty($matches[1]);
    }

}

?>