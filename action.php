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
class ActionPluginHoB extends DokuWiki_Action_Plugin
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
        $event['query'] = $this->VNUnsigned($event['query']);
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
        $event['id'] = $this->VNUnsigned($event['id']);
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
            "/([àáạảãâầấậẩẫăằắặẳẵ])/",
            "/([èéẹẻẽêềếệểễ])/",
            "/([ìíịỉĩ])/",
            "/([òóọỏõôồốộổỗơờớợởỡ])/",
            "/([ùúụủũưừứựửữ])/",
            "/([ỳýỵỷỹ])/",
            "/(đ)/",
            "/([ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴ])/",
            "/([ÈÉẸẺẼÊỀẾỆỂỄ])/",
            "/([ÌÍỊỈĨ])/",
            "/([ÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠ])/",
            "/([ÙÚỤỦŨƯỪỨỰỬỮ])/",
            "/([ỲÝỴỶỸ])/",
            "/(Đ)/"
        ), array(
            'a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D'
        ), $str);
    }
}
