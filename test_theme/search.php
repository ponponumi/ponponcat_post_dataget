<?php get_header() ?>

<h1>検索結果</h1>

<table>
    <thead>
        <tr>
            <th>データの内容</th>
            <th>取得結果</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>検索ワード</td>
            <td><?php \Ponponumi\PonponcatPostDataget\SearchResult::word() ?></td>
        </tr>
    </tbody>
</table>

<?php get_footer() ?>
