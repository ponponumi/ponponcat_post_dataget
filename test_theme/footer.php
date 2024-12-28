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
        </tbody>
    </table>
</body>
</html>
