<?php

namespace Ponponumi\PonponcatPostDataget;

class SearchResult
{
    public static function wordGet(bool $escMode=true): string
    {
        $word = get_search_query(false);

        if($escMode){
            // エスケープする場合
            $word = htmlspecialchars($word, ENT_QUOTES);
        }

        return $word;
    }

    public static function word(): void
    {
        echo self::wordGet();
    }
}
