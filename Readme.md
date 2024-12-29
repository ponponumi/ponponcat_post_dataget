# ponponcat_post_dataget

このパッケージは、WordPressの投稿関係のデータを取得する、ライブラリです。

このパッケージは、ponponcat向けに制作されたものですが、ponponcat以外のテーマでも使用可能です。

## Composerでのインストールについて

次のコマンドを実行する事で、インストール可能です。

```bash
composer require ponponumi/ponponcat_post_dataget
```

## カスタム投稿の注意点について

このライブラリでは、WordPressのカスタム投稿の年別アーカイブ、月別アーカイブ、日別アーカイブの取得自体は可能です。

しかし、パーマリンクを追加する機能はありません。

カスタム投稿の年別アーカイブ、月別アーカイブ、日別アーカイブの取得をする場合は、次のいずれかを行って下さい。

* テーマに、カスタム投稿のパーマリンクを追加するPHPコードを記述する
* WordPressのプラグインを使う
* プラグインを自作する

## パッケージの読み込みについて

functions.phpに、次のように入力してください。(autoload.phpへのパスは、必要に応じて修正してください)

```php
require_once __DIR__ . "/vendor/autoload.php";

use Ponponumi\PonponcatPostDataget\ArchivePage;
use Ponponumi\PonponcatPostDataget\TopPage;
```

## メソッドの種類について

このライブラリのメソッドは、全て静的メソッドとして制作されています。

そのため、インスタンスを生成する必要はありません。

## TopPageクラスについて

以下のようなメソッドがございます。

### settingIsNewPost(): boolean

このメソッドは、トップページの設定が「最新の投稿」ならtrue、「固定ページ」ならfalseを返します。

引数はありません。

```php
$topIsNewPost = TopPage::settingIsNewPost();
var_dump($topIsNewPost);    // トップページの設定が「最新の投稿」ならtrue、「固定ページ」ならfalse
```

### settingIsFixedPage(): boolean

このメソッドは、トップページの設定が「固定ページ」ならtrue、「最新の投稿」ならfalseを返します。

簡単にいえば、settingIsNewPostメソッドとは、逆の動きをします。

引数はありません。

```php
$topIsFixedPage = TopPage::settingIsFixedPage();
var_dump($topIsFixedPage);  // トップページの設定が「固定ページ」ならtrue、「最新の投稿」ならfalse
```

### postTopPageUrlGet(): string

このメソッドは、このメソッドでは、投稿ページのトップページのURLを返します。

なお、こちらは**カスタム投稿タイプには対応しておりません。**

カスタム投稿タイプに対応させる場合、**後述するArchivePageクラスのallCategoryUrlGetメソッドを使ってください。**

例えば、WordPressが`https://example.com`というドメインで動いている場合、次のようになります。

| トップページの設定 | 戻り値 |
| ---- | ---- |
| 最新の投稿 | `https://example.com/` |
| 固定ページ(投稿ページのURLスラッグが「blog」) | `https://example.com/blog/` |

引数はありません。

```php
$postTopPage = TopPage::postTopPageUrlGet();
var_dump($postTopPage);     // 戻り値は上記の表のようになります
```

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
