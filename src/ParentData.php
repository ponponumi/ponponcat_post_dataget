<?php

namespace Ponponumi\PonponcatPostDataget;

use WP_Term;

class ParentData
{
    public static function parentCategoriesGet(WP_Term $categoryObject, bool $nowCategoryAdd=true): array
    {
        // 親カテゴリーを取得
        $result = [];

        if($nowCategoryAdd){
            $result[] = $categoryObject;
        }

        while(true){
            if($categoryObject->parent === 0){
                // 親カテゴリーがなくなったら
                break;
            }

            $categoryObject = get_category($categoryObject->parent);
            $result[] = $categoryObject;
        }

        $result = array_reverse($result);

        return $result;
    }

    public static function nowPageParentCategoriesGet(int $singleCategoryIndex=0, bool $nowCategoryAdd=true): array
    {
        // 現在のページの親カテゴリーを取得
        // カテゴリー別のアーカイブページ、カテゴリー対応の投稿ページ以外では空の配列を返す
        $result = [];
        $categoryObject = null;

        if(ArchivePage::categorySupportCheck() && is_single()){
            // 現在がカテゴリーがサポートされた記事ページであれば
            $categories = get_the_category();

            if(!empty($categories)){
                $categoryObject = $categories[$singleCategoryIndex];
            }

        }elseif(is_category()){
            // カテゴリー別アーカイブページであれば
            $categoryObject = get_queried_object();
        }

        if($categoryObject !== null){
            $result = self::parentCategoriesGet($categoryObject, $nowCategoryAdd);
        }

        return $result;
    }

    public static function fixedPageParentGet($fixedPageObject, bool $nowPageAdd=false): array
    {
        // 固定ページの親ページを取得
        $result = [];

        if($nowPageAdd){
            $result[] = $fixedPageObject;
        }

        while(true){
            if($fixedPageObject->post_parent === 0){
                // 親ページがなくなったら
                break;
            }

            $fixedPageObject = get_post($fixedPageObject->post_parent);
            $result[] = $fixedPageObject;
        }

        $result = array_reverse($result);

        return $result;
    }

    public static function nowFixedPageParentGet(bool $nowPageAdd=false): array
    {
        // 現在の固定ページの親ページを取得
        // 現在が固定ページ以外の場合は空の配列を返す
        $result = [];

        if(is_page()){
            // 現在が固定ページであれば
            $fixedPageObject = get_queried_object();
            $result = self::fixedPageParentGet($fixedPageObject,$nowPageAdd);
        }

        return $result;
    }
}
