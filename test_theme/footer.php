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
        </tbody>
    </table>
</body>
</html>
