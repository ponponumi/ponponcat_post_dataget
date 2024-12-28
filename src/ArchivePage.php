<?php

namespace Ponponumi\PonponcatPostDataget;

class ArchivePage
{
    public static function postTypeGet(string $postType=""): string
    {
        // 現在の投稿タイプのURLを取得
        if (is_singular()) {
            // 記事ページの場合
            $postType = get_post_type();
        } elseif (is_post_type_archive()) {
            // アーカイブページの場合
            $postType = get_query_var("post_type");
        }

        return $postType;
    }

    public static function allCategoryUrlGet(): string
    {
        $url = "";
        $type = self::postTypeGet();

        if($type === "" || $type === "post"){
            // カスタム投稿タイプでなければ
            $url = TopPage::postTopPageUrlGet();
        }else{
            $url = get_post_type_archive_link($type);

            if(!$url){
                return "";
            }
        }

        return $url;
    }
}
