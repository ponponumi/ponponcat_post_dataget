<?php

namespace Ponponumi\PonponcatDataget;

class ArchivePage
{
    public static function postTypeGet(): string
    {
        // 現在の投稿タイプのURLを取得
        $postType = "";

        if (is_singular()) {
            // 記事ページの場合
            $postType = get_post_type();
        } elseif (is_post_type_archive()) {
            // アーカイブページの場合
            $postType = get_query_var("post_type");
        }

        return $postType;
    }
}
