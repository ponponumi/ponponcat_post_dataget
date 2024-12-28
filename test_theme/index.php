<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト</title>
</head>
<body>
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
        </tbody>
    </table>
</body>
</html>
