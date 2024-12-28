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

    /**
     * 今がカスタム投稿タイプかどうかを判定します。カスタム投稿タイプの場合はtrue、カスタム投稿タイプでない場合はfalseを返します。
     * @return bool
     */
    public static function isCustomPostType(): bool
    {
        // 今がカスタム投稿タイプかどうか
        $type = self::postTypeGet();

        if($type !== "" && $type !== "post"){
            return true;
        }

        return false;
    }

    /**
     * 投稿ページ、またはアーカイブページにいる際、現在の投稿タイプを取得します。カスタム投稿タイプでない投稿であれば、defaultTitleで渡した値を返します。front-page.phpやhome.phpが読み込まれる場合、空文字を返します。
     * @param string $defaultTitle
     * @return string
     */
    public static function postTypeTitleGet(string $defaultTitle=""): string
    {
        // 現在の投稿タイプからタイトルを取得する
        $title = "";
        $type = self::postTypeGet();

        if(self::isCustomPostType()){
            // カスタム投稿タイプであれば
            $data = get_post_type_object($type);
            $title = $data->labels->singular_name;
        }elseif($type === "post"){
            // 通常の投稿ページであれば
            $title = $defaultTitle;
        }

        return $title;
    }

    /**
     * 現在の投稿ページ、またはアーカイブページの、全てのカテゴリを表示するURLを返します。カスタム投稿タイプでない場合、トップページが「最新の投稿」の場合はトップページを、「固定ページ」の場合は投稿ページのトップページを、それぞれ返します。
     *
     * @return string
     */
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

    public static function categorySupportCheck(bool $default=true): bool
    {
        if(self::isCustomPostType()){
            // カスタム投稿の場合
            $type = self::postTypeGet();
            return in_array("category", get_object_taxonomies($type));
        }else{
            // カスタム投稿以外の場合
            return $default;
        }
    }

    public static function categoriesGet(): array
    {
        // カテゴリ一覧を取得
        $check = self::categorySupportCheck();

        if(!$check){
            // カテゴリがサポートされていない場合
            return [];
        }

        $result = [];
        $type = self::postTypeGet();

        if($type !== ""){
            $type = "post";
        }

        $categories = get_terms([
            "taxonomy" => "category",
            "post_type" => $type,
            "orderby" => "name",
            "hide_empty" => false,
        ]);

        if (!is_wp_error($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                $url = get_term_link($category);

                if(!is_wp_error($url)){
                    $result[] = [
                        "url" => $url,
                        "name" => $category->name,
                    ];
                }
            }
        }

        return $result;
    }
}
