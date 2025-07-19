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

    public static function titleGet(string $leftAdd="", string $rightAdd="", bool $escMode=true): string
    {
        if(!is_search()){
            return "";
        }

        $word = self::wordGet(false);
        $word = $leftAdd . $word . $rightAdd;

        if($escMode){
            $word = htmlspecialchars($word, ENT_QUOTES);
        }

        return $word;
    }

    public static function title(string $leftAdd="", string $rightAdd=""): void
    {
        echo self::titleGet($leftAdd, $rightAdd);
    }
}
