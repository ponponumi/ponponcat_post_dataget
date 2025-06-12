<?php

namespace Ponponumi\PonponcatPostDataget;

use WP_Term;
use WP_Post;

class ParentData
{
    /**
     * 親カテゴリーを取得します。
     *
     * @param WP_Term $categoryObject ここには、カテゴリーのオブジェクト(get_the_category関数などで取得したもの)を渡してください。
     * @param boolean $nowCategoryAdd 現在のカテゴリーを追加するかどうかを選んでください。デフォルトは「true」です。
     * @return array
     */
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

    /**
     * 現在のページの親のカテゴリーを取得します。
     *
     * @param integer $singleCategoryIndex どのインデックスのカテゴリーを取得するか選びます。デフォルトは0です。
     * @param boolean $nowCategoryAdd 現在のカテゴリーを追加するかどうかを選んでください。デフォルトは「true」です。
     * @return array
     */
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

    /**
     * 固定ページの親ページを取得します。
     *
     * @param \WP_Post $fixedPageObject ここには、固定ページのオブジェクト(get_queried_object関数などで取得したもの)を渡してください。
     * @param bool $nowPageAdd 現在のページを追加するか選んでください。デフォルトは「false」です。
     * @return array<array|WP_Post|null>
     */
    public static function fixedPageParentGet(WP_Post $fixedPageObject, bool $nowPageAdd=false): array
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

    /**
     * 現在の固定ページの親ページを取得します。
     *
     * @param boolean $nowPageAdd 現在のページを追加するか選んでください。デフォルトは「false」です。
     * @return array
     */
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

    /**
     * 現在のぺージの親に相当する、年別、月別、日別のアーカイブを取得します。現在のページが投稿ページ、月別、日別のアーカイブの場合に機能し、それ以外は空の配列を返します。
     *
     * @param string $yearFormat ここには、年別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。デフォルトでは「Y」です。
     * @param string $monthFormat ここには、月別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。デフォルトでは「Y/n」です。
     * @param string $dayFormat ここには、日別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。デフォルトでは「Y/n/j」です。
     * @param string $nameKey ここには、戻り値の配列のキー(日付形式)の名前を渡してください。デフォルトでは「name」です。
     * @param string $linkKey ここには、戻り値の配列のキー(URL)の名前を渡してください。デフォルトでは「link」です。
     * @param string $howFar ここには、現在のページが投稿ページの場合、どこまで取得するかを渡してください。「y」の場合は年まで、「m」の場合は月まで、「d」の場合は日付までとなります。
     * @return array<bool|int|string>[]
     */
    public static function nowPageDateArchiveGet(
        string $yearFormat="Y",
        string $monthFormat="Y/n",
        string $dayFormat="Y/n/j",
        string $nameKey="name",
        string $linkKey="link",
        string $howFar="m"
    ): array
    {
        // 現在のぺージの親に相当する、年別、月別、日別のアーカイブを取得
        // 現在のページが投稿ページ、月別、日別のアーカイブの場合に機能し、それ以外は空の配列を返す
        $result = [];

        if(is_single()){
            // 記事ページであれば
            $result[] = [
                $nameKey => get_the_date($yearFormat),
                $linkKey => ArchivePage::nowPageYearArchiveUrlGet(),
            ];

            if($howFar === "y"){
                return $result;
            }

            $result[] = [
                $nameKey => get_the_date($monthFormat),
                $linkKey => ArchivePage::nowPageMonthArchiveUrlGet(),
            ];

            if($howFar === "m"){
                return $result;
            }

            $result[] = [
                $nameKey => get_the_date($dayFormat),
                $linkKey => ArchivePage::nowPageDateArchiveUrlGet(),
            ];
        }elseif(is_month()){
            // 月別アーカイブであれば
            $result[] = [
                $nameKey => get_the_date($yearFormat),
                $linkKey => ArchivePage::nowPageYearArchiveUrlGet(),
            ];
        }elseif(is_day()){
            // 日別アーカイブであれば
            $result[] = [
                $nameKey => get_the_date($yearFormat),
                $linkKey => ArchivePage::nowPageYearArchiveUrlGet(),
            ];

            $result[] = [
                $nameKey => get_the_date($monthFormat),
                $linkKey => ArchivePage::nowPageMonthArchiveUrlGet(),
            ];
        }

        return $result;
    }
}
