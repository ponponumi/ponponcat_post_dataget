<?php

namespace Ponponumi\PonponcatDataget;

class TopPage
{
    public static function isNewPost(): bool
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
}
