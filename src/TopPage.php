<?php

namespace Ponponumi\PonponcatDataget;

class TopPage
{
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

    public static function settingIsFixedPage(): bool
    {
        // トップページが「固定ページ」ならtrue、「最新の投稿」ならfalseを返す
        return !self::settingIsNewPost();
    }
}
