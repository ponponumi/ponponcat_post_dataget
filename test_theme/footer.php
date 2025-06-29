    </div>
    <table>
        <thead>
            <tr>
                <th>データの内容</th>
                <th>現在の設定</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>トップページが「最新の投稿」かどうか</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\TopPage::settingIsNewPost()) ?></td>
            </tr>
            <tr>
                <td>トップページが「固定ページ」かどうか</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\TopPage::settingIsFixedPage()) ?></td>
            </tr>
            <tr>
                <td>ブログのトップページのURL</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\TopPage::postTopPageUrlGet()) ?></td>
            </tr>
            <tr>
                <td>現在の投稿タイプの名前</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::postTypeGet()) ?></td>
            </tr>
            <tr>
                <td>現在がカスタム投稿タイプかどうか</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::isCustomPostType()) ?></td>
            </tr>
            <tr>
                <td>現在の投稿タイプのタイトル</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::postTypeTitleGet("ブログ")) ?></td>
            </tr>
            <tr>
                <td>全てのカテゴリのURL</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::allCategoryUrlGet()) ?></td>
            </tr>
            <tr>
                <td>カテゴリをサポートするかどうか</td>
                <td><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::categorySupportCheck()) ?></td>
            </tr>
            <tr>
                <td>カテゴリ一覧</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::categoriesGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿年アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::yearsGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿年アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::yearsUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿月アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::monthsGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿月アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::monthsUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿日アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::datesGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>投稿日アーカイブ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::datesUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在の投稿タイプにアーカイブページがあるかどうか</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::nowPostTypeArchive()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のカテゴリーと親カテゴリー</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageParentCategoriesGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のカテゴリーと親カテゴリー(最初)</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageParentCategoriesGet(512)) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のカテゴリーと親カテゴリー(最後)</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageParentCategoriesGet(512,notIndexMode: "end")) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のカテゴリーと親カテゴリー(エラー)</td>
                <td>
                    <pre><?php

                    try{
                        var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageParentCategoriesGet(512,notIndexMode: "error"));
                    }catch(Exception $e){
                        var_dump($e);
                    }

                    ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページと親ページ</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowFixedPageParentGet(true)) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの年</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::nowPageYearArchiveUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの月</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::nowPageMonthArchiveUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの日</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ArchivePage::nowPageDateArchiveUrlGet()) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの親の時期別アーカイブ(年まで)</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageDateArchiveGet(
                        howFar: "y",
                        yearFormat: "Y年",
                        monthFormat: "Y年n月",
                        dayFormat: "Y年n月j日"
                    )) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの親の時期別アーカイブ(月まで)</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageDateArchiveGet(
                        howFar: "m",
                        yearFormat: "Y年",
                        monthFormat: "Y年n月",
                        dayFormat: "Y年n月j日"
                    )) ?></pre>
                </td>
            </tr>
            <tr>
                <td>現在のページの親の時期別アーカイブ(日まで)</td>
                <td>
                    <pre><?php var_dump(\Ponponumi\PonponcatPostDataget\ParentData::nowPageDateArchiveGet(
                        howFar: "d",
                        yearFormat: "Y年",
                        monthFormat: "Y年n月",
                        dayFormat: "Y年n月j日"
                    )) ?></pre>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
