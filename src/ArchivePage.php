<?php

namespace Ponponumi\PonponcatPostDataget;

class ArchivePage
{
    /**
     * 投稿ページ、またはアーカイブページにいる際、現在の投稿タイプを取得します。カスタム投稿タイプでない投稿であれば、postを返します。front-page.phpやhome.phpが読み込まれる場合、空文字を返します。
     * @return string
     */
    public static function postTypeGet(): string
    {
        // 現在の投稿タイプの名前を取得
        $postType = "";

        if (is_single()) {
            // 記事ページの場合
            $postType = get_post_type();
        } elseif (is_post_type_archive()) {
            // アーカイブページの場合
            $postType = get_query_var("post_type");
        } elseif (is_archive()) {
            $postType = "post";
        }

        return $postType;
    }

    public static function postTypeTitleGet(string $defaultTitle=""): string
    {
        // 現在の投稿タイプからタイトルを取得する
        $title = "";
        $type = self::postTypeGet();

        if($type !== "" && $type !== "post"){
            // カスタム投稿タイプであれば
            $data = get_post_type_object($type);
            $title = $data->labels->singular_name;
        }elseif($type === "post"){
            // 通常の投稿ページであれば
            $title = $defaultTitle;
        }

        return $title;
    }

    public static function allCategoryUrlGet(): string
    {
        // 現在の投稿タイプのURLを取得
        // 現在が投稿ページ、アーカイブページでない場合、無条件で投稿ページのトップURLを取得する
        $url = "";
        $type = self::postTypeGet();

        if($type === "" || $type === "post"){
            // カスタム投稿タイプでなければ
            $url = TopPage::postTopPageUrlGet();
        }else{
            // カスタム投稿タイプであれば
            $url = get_post_type_archive_link($type);

            if(!$url){
                return "";
            }
        }

        return $url;
    }
}
