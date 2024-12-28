<?php

namespace Ponponumi\PonponcatDataget;

class TopPage
{
    /**
     * このメソッドでは、トップページの設定が「最新の投稿」ならtrue、「固定ページ」ならfalseを返します。：
     * @return bool
     */
    public static function settingIsNewPost(): bool
    {
        // トップページが「最新の投稿」ならtrue、「固定ページ」ならfalseを返す
        $topOption = get_option("show_on_front");

        if($topOption === "posts"){
            // ホームページが最新の投稿なら
            return true;
        }else{
            // ホームページが固定ページなら
            return false;
        }
    }

    /**
     * このメソッドでは、トップページの設定が「固定ページ」ならtrue、「最新の投稿」ならfalseを返します。：
     * @return bool
     */
    public static function settingIsFixedPage(): bool
    {
        // トップページが「固定ページ」ならtrue、「最新の投稿」ならfalseを返す
        return !self::settingIsNewPost();
    }

    public static function postTopPageUrlGet(): string
    {
        // 投稿ページのトップページのURLを取得する
        if(self::settingIsNewPost()){
            // 最新の投稿なら
            return home_url();
        }else{
            // 固定ページなら
            return get_permalink(get_option("page_for_posts"));
        }
    }
}
