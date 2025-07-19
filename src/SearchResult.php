<?php

namespace Ponponumi\PonponcatPostDataget;

class SearchResult
{
    /**
     * 検索ワードを取得します。検索ページ以外では、空の文字列を返します。
     *
     * @param bool $escMode htmlspecialchars関数で、エスケープするかどうかを選びます。
     * @return string
     */
    public static function wordGet(bool $escMode=true): string
    {
        if(!is_search()){
            return "";
        }

        $word = get_search_query(false);

        if($escMode){
            // エスケープする場合
            $word = htmlspecialchars($word, ENT_QUOTES);
        }

        return $word;
    }

    /**
     * 検索ワードを出力します。
     *
     * @return void
     */
    public static function word(): void
    {
        echo self::wordGet();
    }

    /**
     * 検索結果ページのタイトルを取得します。
     *
     * @param string $leftAdd 左側に追加します。「こんにちは」と検索し、「ワード: こんにちは の検索結果」としたい場合、ここには「ワード: 」と渡してください。
     * @param string $rightAdd 右側に追加します。「こんにちは」と検索し、「ワード: こんにちは の検索結果」としたい場合、ここには「 の検索結果」と渡してください。
     * @param bool $escMode htmlspecialchars関数で、エスケープするかどうかを選びます。
     * @return string
     */
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

    /**
     * 検索結果ページのタイトルを出力します。
     *
     * @param string $leftAdd 左側に追加します。「こんにちは」と検索し、「ワード: こんにちは の検索結果」としたい場合、ここには「ワード: 」と渡してください。
     * @param string $rightAdd 右側に追加します。「こんにちは」と検索し、「ワード: こんにちは の検索結果」としたい場合、ここには「 の検索結果」と渡してください。
     * @return void
     */
    public static function title(string $leftAdd="", string $rightAdd=""): void
    {
        echo self::titleGet($leftAdd, $rightAdd);
    }
}
