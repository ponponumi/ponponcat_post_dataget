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
}
