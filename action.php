<?php
/**
 * HoB Feature for HoB Wiki
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Hoang Bui <bmhoang@outlook.com>
 */

/**
 * Register handler
 */
class action_plugin_hob extends DokuWiki_Action_Plugin
{

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('INDEXER_TEXT_PREPARE', 'BEFORE', $this, 'handleTextIndexer');
        $controller->register_hook('SEARCH_QUERY_FULLPAGE', 'BEFORE', $this, 'handleSearchQuery');
        $controller->register_hook('SEARCH_QUERY_PAGELOOKUP', 'BEFORE', $this, 'handleSearchQueryPageLookup');
        $controller->register_hook('FULLTEXT_SNIPPET_CREATE', 'BEFORE', $this, 'handleFulltextSnippet');
        $controller->register_hook('FULLTEXT_PHRASE_MATCH', 'BEFORE', $this, 'handleFulltextSnippet');
    }

    /**
     * Text indexer
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed $param  empty
     * @return void
     */
    public function handleSearchQuery(Doku_Event $event, $param)
    {
        $event->data['query'] = $this->VNUnsigned($event->data['query']);
    }

    /**
     * Text indexer
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed $param  empty
     * @return void
     */
    public function handleSearchQueryPageLookup(Doku_Event $event, $param)
    {
        $event->data['id'] = $this->VNUnsigned($event->data['id']);
    }

    /**
     * Text indexer
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed $param  empty
     * @return void
     */
    public function handleTextIndexer(Doku_Event $event, $param)
    {
        $event->data = $this->VNUnsigned($event->data);
    }
    /**
     * Fulltext snippet
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed $param  empty
     * @return void
     */
    public function handleFulltextSnippet(Doku_Event $event, $param)
    {
        $event->data['text'] = $this->VNUnsigned($event->data['text']);
    }

    function VNUnsigned($str) {
        return preg_replace(array(
            "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/",
            "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/",
            "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/",
            "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/",
            "/(ì|í|ị|ỉ|ĩ)/",
            "/(ỳ|ý|ỵ|ỷ|ỹ)/",
            "/(đ)/",
            "/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/",
            "/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/",
            "/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/",
            "/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/",
            "/(Ì|Í|Ị|Ỉ|Ĩ)/",
            "/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",
            "/(Đ)/",
        ), array('a','o','e','u','i','y','d','A','O','E','U','I','Y','D'), $str);
    }
}
