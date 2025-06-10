<?php

namespace Ponponumi\PonponcatPostDataget;

use WP_Term;

class ParentData
{
    public static function parentCategoriesGet(WP_Term $categoryObject): array
    {
        // 親カテゴリーを取得
        $result = [];

        while(true){
            $result[] = $categoryObject;

            if($categoryObject->parent === 0){
                // 親カテゴリーがなくなったら
                break;
            }

            $categoryObject = get_category($categoryObject->parent);
        }

        $result = array_reverse($result);

        return $result;
    }
}
