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

#### サンプルコード

```php
$topIsNewPost = TopPage::settingIsNewPost();
var_dump($topIsNewPost);    // トップページの設定が「最新の投稿」ならtrue、「固定ページ」ならfalse
```

### settingIsFixedPage(): boolean

このメソッドは、トップページの設定が「固定ページ」ならtrue、「最新の投稿」ならfalseを返します。

簡単にいえば、settingIsNewPostメソッドとは、逆の動きをします。

引数はありません。

#### サンプルコード

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

#### サンプルコード

```php
$postTopPage = TopPage::postTopPageUrlGet();
var_dump($postTopPage);     // 戻り値は上記の表のようになります
```

## ArchivePageクラスについて

以下のようなメソッドがございます。

### postTypeGet(): string

このメソッドでは、現在の投稿タイプを返します。

なお、「アーカイブページ」または「投稿ページ」ではない場合(例:「front-page.php」、「home.php」、「page.php」などが読み込まれる場合)では、「`post`」ではなく「**空の文字列**」を返しますので、ご注意ください。

| 投稿タイプ | 戻り値 |
| ---- | ---- |
| 通常の投稿タイプ | `post` |
| カスタム投稿タイプ(投稿タイプ名が「event_info」) | `event_info` |
| カスタム投稿タイプ(投稿タイプ名が「important」) | `important` |

引数はありません。

#### サンプルコード

```php
$postType = ArchivePage::postTypeGet();
var_dump($postType);    // 戻り値は上記の表のようになります
```

### isCustomPostType(): bool

このメソッドでは、現在がカスタム投稿タイプかどうかを返します。

カスタム投稿タイプの投稿ページ、またはアーカイブページの場合はtrue、それ以外はfalseを返します。

引数はありません。

#### サンプルコード

```php
$isCustomPostType = ArchivePage::isCustomPostType();
var_dump($isCustomPostType);    // カスタム投稿タイプの投稿ページ、アーカイブページならtrue、それ以外はfalse
```

### postTypeTitleGet(string $defaultTitle=""): string

このメソッドでは、現在の投稿タイプのタイトルを取得します。

カスタム投稿タイプでない投稿であれば、defaultTitleで渡した値を返します。

トップページや固定ページであれば、空の文字列を返します。

#### 引数について

##### string $defaultTitle

通常の投稿タイプの場合、表示する文字列を渡してください。

省略した場合は「空の文字列」になります

#### サンプルコード

```php
$postTypeTitle = ArchivePage::postTypeTitleGet("ブログ");
var_dump($postTypeTitle);   // カスタム投稿タイプの場合はその投稿タイプの名前、通常の投稿タイプならこの場合は「ブログ」
```

```php
$postTypeTitle = ArchivePage::postTypeTitleGet("BLOG");
var_dump($postTypeTitle);   // カスタム投稿タイプの場合はその投稿タイプの名前、通常の投稿タイプならこの場合は「BLOG」
```

### allCategoryUrlGet(): string

このメソッドでは、現在の投稿タイプの全てのカテゴリの、記事一覧ページへのURLを返します。

カスタム投稿タイプの場合は、その投稿タイプの記事一覧ページへのURLを返します。

カスタム投稿タイプ以外の場合は、TopPageクラスのpostTypeGetメソッドと同じ動きをします。

引数はありません。

例えば、WordPressが`https://example.com`というドメインで動いている場合、次のようになります。

| 現在のページ | トップページの設定 | 戻り値 |
| ---- | ---- | ---- |
| 通常の投稿タイプ | 最新の投稿 | `https://example.com/` 
| 通常の投稿タイプ | 固定ページ(投稿ページのURLスラッグが「blog」) | `https://example.com/blog/`
| カスタム投稿タイプ(投稿タイプ名は「event_info」) | どちらでも | `https://example.com/event_info/`
| 固定ページ | 最新の投稿 | `https://example.com/` 
| 固定ページ | 固定ページ(投稿ページのURLスラッグが「blog」) | `https://example.com/blog/`
| トップページ | 最新の投稿 | `https://example.com/` 
| トップページ | 固定ページ(投稿ページのURLスラッグが「blog」) | `https://example.com/blog/`
| ホームページ | 最新の投稿 | `https://example.com/` 
| ホームページ | 固定ページ(投稿ページのURLスラッグが「blog」) | `https://example.com/blog/`

#### サンプルコード

```php
$allCategoryUrl = ArchivePage::allCategoryUrlGet();
var_dump($allCategoryUrl);  // 戻り値は上記の表のようになります
```

### categorySupportCheck(bool $default=true): bool

カスタム投稿の場合、カテゴリをサポート中かどうかを返します。

カテゴリをサポート中の場合はtrue、サポート中でない場合はfalseを返します。

カスタム投稿以外の場合、defaultに渡した値(省略した場合はtrue)を返します。

#### 引数について

##### bool $default

カスタム投稿以外の場合、返す値を渡して下さい。

省略した場合はtrueになります。

#### サンプルコード

```php
$categorySupportCheck = ArchivePage::categorySupportCheck(true);
var_dump($categorySupportCheck);    // カテゴリをサポート中の場合はtrue、サポート中でない場合はfalse、カスタム投稿以外の場合はdefaultの値
```

### categoriesGet(): array

現在の投稿タイプのカテゴリ一覧を返します。

カテゴリがサポートされていないカスタム投稿の場合、空の配列を返します。

引数はありません。

#### サンプルコード

```php
$categories = ArchivePage::categoriesGet();
var_dump($categories);  // 以下の配列と同じような形式の配列になります。

$result = [
    [
        "url" => "https://example.com/category/php/",
        "name" => "PHP",
    ],
    [
        "url" => "https://example.com/category/wordpress/",
        "name" => "wordpress",
    ],
    [
        "url" => "https://example.com/category/uncategorized/",
        "name" => "未分類",
    ],
];
```

### yearsGet(): array

現在の投稿タイプの投稿年一覧を取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿年一覧を返します。

引数はありません。

#### サンプルコード

```php
$years = ArchivePage::yearsGet();
var_dump($years);   // 以下の配列と同じような形式の配列になります。

$result = [
    "2024",
    "2023",
    "2022",
];
```

### monthsGet(): array

現在の投稿タイプの投稿月一覧を取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿月一覧を返します。

引数はありません。

#### サンプルコード

```php
$months = ArchivePage::monthsGet();
var_dump($months);  // 以下の配列と同じような形式の配列になります。

$result = [
    "2024/12",
    "2024/11",
    "2024/7",
];
```

### datesGet(): array

現在の投稿タイプの投稿日一覧を取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿日一覧を返します。

引数はありません。

#### サンプルコード

```php
$dates = ArchivePage::datesGet();
var_dump($dates);   // 以下の配列と同じような形式の配列になります。

$result = [
    "2024/12/12",
    "2024/11/30",
    "2024/11/17",
];
```

### postTypeArchive(string $type): bool

指定した投稿タイプに、アーカイブページがあるかどうかを調べます。

アーカイブページがある場合はtrue、ない場合はfalseを返します。

投稿タイプが見つからない場合はfalseを返します。

#### 引数について

##### string $type

ここには、カスタム投稿タイプの名前を渡して下さい。

#### サンプルコード

```php
$check = ArchivePage::postTypeArchive("event");
var_dump($check);   // 「event」という投稿タイプのアーカイブページが有効ならtrue。無効の場合、投稿タイプがない場合はfalse。
```

### yearsUrlGet(string $format="Y"): array

現在の投稿タイプの投稿年一覧に、URLを含めて取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿年一覧を返します。

#### 引数について

##### string $format

日付のフォーマットを指定してください。

省略した場合は「Y」になります。

#### サンプルコード

```php
$years = ArchivePage::yearsUrlGet("Y年");
var_dump($years);   // 以下の配列と同じような形式の配列になります。

$result = [
    [
        "url" => "https://example.com/2024/",
        "name" => "2024年",
    ],
    [
        "url" => "https://example.com/2023/",
        "name" => "2023年",
    ],
    [
        "url" => "https://example.com/2022/",
        "name" => "2022年",
    ],
];
```

### monthsUrlGet(string $format="Y/n"): array

現在の投稿タイプの投稿月一覧に、URLを含めて取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿月一覧を返します。

#### 引数について

##### string $format

日付のフォーマットを指定してください。

省略した場合は「Y/n」になります。

#### サンプルコード

```php
$months = ArchivePage::monthsUrlGet("Y年n月");
var_dump($months);  // 以下の配列と同じような形式の配列になります。

$result = [
    [
        "url" => "https://example.com/2024/12/",
        "name" => "2024年12月",
    ],
    [
        "url" => "https://example.com/2024/11/",
        "name" => "2024年11月",
    ],
    [
        "url" => "https://example.com/2024/7/",
        "name" => "2024年7月",
    ],
];
```

### datesUrlGet(string $format="Y/n/j"): array

現在の投稿タイプの投稿日一覧に、URLを含めて取得します。

現在が投稿関係のページではない場合、通常の投稿タイプの投稿日一覧を返します。

#### 引数について

##### string $format

日付のフォーマットを指定してください。

省略した場合は「Y/n/j」になります。

#### サンプルコード

```php
$dates = ArchivePage::datesUrlGet("Y年n月j日");
var_dump($dates);   // 以下の配列と同じような形式の配列になります。

$result = [
    [
        "url" => "https://example.com/2024/12/12/",
        "name" => "2024年12月12日",
    ],
    [
        "url" => "https://example.com/2024/11/30/",
        "name" => "2024年11月30日",
    ],
    [
        "url" => "https://example.com/2024/11/17/",
        "name" => "2024年11月17日",
    ],
];
```

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
