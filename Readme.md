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

### dateArchiveUrlGet(int $year,int $month,int $day,string $postType="",string $howFar="d"): string

日付から、日別アーカイブページへのURLを取得します。

#### 引数について

##### int $year

ここには、アーカイブページの年を渡してください。

##### int $month

ここには、アーカイブページの月を渡してください。

##### int $day

ここには、アーカイブページの日を渡してください。

##### string $postType=""

ここには、投稿タイプの名前を渡してください。

通常の投稿タイプの場合、空文字、またはpostにしてください。

カスタム投稿タイプの場合、その名前を渡してください。

##### string $howFar="d"

ここには、どこまで取得するかを渡してください。

「y」の場合は年別アーカイブ、「m」の場合は月別アーカイブ、「d」の場合は日別アーカイブになります。

初期状態は「d」になります。

#### サンプルコード

```php
$url = ArchivePage::dateArchiveUrlGet(2025, 6, 12, "event");
var_dump($url);   // 「http://localhost:5520/2025/06/12/?post_type=event」と出力されます
```

### monthArchiveUrlGet(int $year,int $month,string $postType=""): string

月から、月別アーカイブページへのURLを取得します。

#### 引数について

##### int $year

ここには、アーカイブページの年を渡してください。

##### int $month

ここには、アーカイブページの月を渡してください。

##### string $postType=""

ここには、投稿タイプの名前を渡してください。

通常の投稿タイプの場合、空文字、またはpostにしてください。

カスタム投稿タイプの場合、その名前を渡してください。

#### サンプルコード

```php
$url = ArchivePage::monthArchiveUrlGet(2025, 6, "event");
var_dump($url);   // 「http://localhost:5520/2025/06/?post_type=event」と出力されます
```

### yearArchiveUrlGet(int $year,string $postType=""): string

年から、年別アーカイブページへのURLを取得します。

#### 引数について

##### int $year

ここには、アーカイブページの年を渡してください。

##### string $postType=""

ここには、投稿タイプの名前を渡してください。

通常の投稿タイプの場合、空文字、またはpostにしてください。

カスタム投稿タイプの場合、その名前を渡してください。

#### サンプルコード

```php
$url = ArchivePage::yearArchiveUrlGet(2025, "event");
var_dump($url);   // 「http://localhost:5520/2025/?post_type=event」と出力されます
```

### nowPageDateArchiveUrlGet(string $howFar="d"): string

現在のページに対応する、日別アーカイブのURLを取得します。

#### 引数について

##### string $howFar="d"

ここには、どこまで取得するかを渡してください。

「y」の場合は年別アーカイブ、「m」の場合は月別アーカイブ、「d」の場合は日別アーカイブになります。

初期状態は「d」になります。

#### サンプルコード

```php
$url = ArchivePage::nowPageDateArchiveUrlGet();
var_dump($url);   // 「http://localhost:5520/2025/06/12/?post_type=event」という感じで出力されます
```

### nowPageMonthArchiveUrlGet(): string

現在のページに対応する、月別アーカイブのURLを取得します。

引数はありません。

#### サンプルコード

```php
$url = ArchivePage::nowPageMonthArchiveUrlGet();
var_dump($url);   // 「http://localhost:5520/2025/06/?post_type=event」という感じで出力されます
```

### nowPageYearArchiveUrlGet(): string

現在のページに対応する、年別アーカイブのURLを取得します。

引数はありません。

#### サンプルコード

```php
$url = ArchivePage::nowPageYearArchiveUrlGet();
var_dump($url);   // 「http://localhost:5520/2025/?post_type=event」という感じで出力されます
```

## ParentDataクラスについて

以下のようなメソッドがございます。

### parentCategoriesGet(WP_Term $categoryObject, bool $nowCategoryAdd=true): array

親カテゴリーを取得します。

#### 引数について

##### $categoryObject

ここには、カテゴリーのオブジェクト(get_the_category関数などで取得したもの)を渡してください。

##### bool $nowCategoryAdd=true

現在のカテゴリーを追加するかどうかを選んでください。デフォルトは「true」です。

#### サンプルコード

```php
$categories = get_the_category();

if(!empty($categories)){
    $category = $categories[0];

    $parentCategories = ParentData::parentCategoriesGet($category, true);
    var_dump($parentCategories);
}
```

次のように出力されます。

<pre>
array(3) {
  [0]=>
  object(WP_Term)#806 (16) {
    ["term_id"]=>
    int(64)
    ["name"]=>
    string(18) "親カテゴリー"
    ["slug"]=>
    string(54) "%e8%a6%aa%e3%82%ab%e3%83%86%e3%82%b4%e3%83%aa%e3%83%bc"
    ["term_group"]=>
    int(0)
    ["term_taxonomy_id"]=>
    int(64)
    ["taxonomy"]=>
    string(8) "category"
    ["description"]=>
    string(0) ""
    ["parent"]=>
    int(0)
    ["count"]=>
    int(1)
    ["filter"]=>
    string(3) "raw"
    ["cat_ID"]=>
    int(64)
    ["category_count"]=>
    int(1)
    ["category_description"]=>
    string(0) ""
    ["cat_name"]=>
    string(18) "親カテゴリー"
    ["category_nicename"]=>
    string(54) "%e8%a6%aa%e3%82%ab%e3%83%86%e3%82%b4%e3%83%aa%e3%83%bc"
    ["category_parent"]=>
    int(0)
  }
  [1]=>
  object(WP_Term)#821 (16) {
    ["term_id"]=>
    int(71)
    ["name"]=>
    string(21) "子カテゴリー 03"
    ["slug"]=>
    string(17) "child-category-03"
    ["term_group"]=>
    int(0)
    ["term_taxonomy_id"]=>
    int(71)
    ["taxonomy"]=>
    string(8) "category"
    ["description"]=>
    string(48) "This is a description for the Child Category 03."
    ["parent"]=>
    int(64)
    ["count"]=>
    int(1)
    ["filter"]=>
    string(3) "raw"
    ["cat_ID"]=>
    int(71)
    ["category_count"]=>
    int(1)
    ["category_description"]=>
    string(48) "This is a description for the Child Category 03."
    ["cat_name"]=>
    string(21) "子カテゴリー 03"
    ["category_nicename"]=>
    string(17) "child-category-03"
    ["category_parent"]=>
    int(64)
  }
  [2]=>
  object(WP_Term)#901 (16) {
    ["term_id"]=>
    int(74)
    ["name"]=>
    string(18) "孫カテゴリー"
    ["slug"]=>
    string(19) "grandchild-category"
    ["term_group"]=>
    int(0)
    ["term_taxonomy_id"]=>
    int(74)
    ["taxonomy"]=>
    string(8) "category"
    ["description"]=>
    string(50) "This is a description for the Grandchild Category."
    ["parent"]=>
    int(71)
    ["count"]=>
    int(1)
    ["filter"]=>
    string(3) "raw"
    ["cat_ID"]=>
    int(74)
    ["category_count"]=>
    int(1)
    ["category_description"]=>
    string(50) "This is a description for the Grandchild Category."
    ["cat_name"]=>
    string(18) "孫カテゴリー"
    ["category_nicename"]=>
    string(19) "grandchild-category"
    ["category_parent"]=>
    int(71)
  }
}
</pre>

### nowPageParentCategoriesGet(int $singleCategoryIndex=0, bool $nowCategoryAdd=true): array

現在のページの親カテゴリーを取得します。

#### 引数について

##### int $singleCategoryIndex=0

現在の記事に複数のカテゴリーがある場合、どのインデックスのカテゴリーを取得するか選びます。

デフォルトは0です。

##### bool $nowCategoryAdd=true

現在のカテゴリーを追加するかどうかを選んでください。

デフォルトは「true」です。

##### string $notIndexMode="start"

カテゴリーのインデックスが見つからない場合、どうするか選んでください。

「start」なら最初、「end」なら最後のカテゴリーを使い、「error」ならエラーを起こします。

初期状態では「start」です。

#### サンプルコード

```php
$parentCategories = ParentData::nowPageParentCategoriesGet();
```

(結果はparentCategoriesGetメソッドのようになります)

### fixedPageParentGet(WP_Post $fixedPageObject, bool $nowPageAdd=false): array

固定ページの親ページを取得します。

#### 引数について

##### WP_Post $fixedPageObject

ここには、固定ページのオブジェクト(get_queried_object関数などで取得したもの)を渡してください。

##### bool $nowPageAdd=false

現在のページを追加するか選んでください。

デフォルトは「false」です。

#### サンプルコード

```php
if(is_page()){
    $fixedPageObject = get_queried_object();
    $parentPage = ParentData::fixedPageParentGet($fixedPageObject, true);
    var_dump($parentPage);
}
```

次のように出力されます。

<pre>
array(3) {
  [0]=>
  object(WP_Post)#1300 (24) {
    ["ID"]=>
    int(2116)
    ["post_author"]=>
    string(1) "1"
    ["post_date"]=>
    string(19) "2025-06-13 12:48:07"
    ["post_date_gmt"]=>
    string(19) "2025-06-13 03:48:07"
    ["post_content"]=>
    string(64) "
テキスト


"
    ["post_title"]=>
    string(19) "テストページ1"
    ["post_excerpt"]=>
    string(0) ""
    ["post_status"]=>
    string(7) "publish"
    ["comment_status"]=>
    string(6) "closed"
    ["ping_status"]=>
    string(6) "closed"
    ["post_password"]=>
    string(0) ""
    ["post_name"]=>
    string(55) "%e3%83%86%e3%82%b9%e3%83%88%e3%83%9a%e3%83%bc%e3%82%b81"
    ["to_ping"]=>
    string(0) ""
    ["pinged"]=>
    string(0) ""
    ["post_modified"]=>
    string(19) "2025-06-13 12:48:07"
    ["post_modified_gmt"]=>
    string(19) "2025-06-13 03:48:07"
    ["post_content_filtered"]=>
    string(0) ""
    ["post_parent"]=>
    int(0)
    ["guid"]=>
    string(35) "http://localhost:5520/?page_id=2116"
    ["menu_order"]=>
    int(0)
    ["post_type"]=>
    string(4) "page"
    ["post_mime_type"]=>
    string(0) ""
    ["comment_count"]=>
    string(1) "0"
    ["filter"]=>
    string(3) "raw"
  }
  [1]=>
  object(WP_Post)#1009 (24) {
    ["ID"]=>
    int(2118)
    ["post_author"]=>
    string(1) "1"
    ["post_date"]=>
    string(19) "2025-06-13 12:48:36"
    ["post_date_gmt"]=>
    string(19) "2025-06-13 03:48:36"
    ["post_content"]=>
    string(64) "
テキスト


"
    ["post_title"]=>
    string(21) "テストページ1-1"
    ["post_excerpt"]=>
    string(0) ""
    ["post_status"]=>
    string(7) "publish"
    ["comment_status"]=>
    string(6) "closed"
    ["ping_status"]=>
    string(6) "closed"
    ["post_password"]=>
    string(0) ""
    ["post_name"]=>
    string(57) "%e3%83%86%e3%82%b9%e3%83%88%e3%83%9a%e3%83%bc%e3%82%b81-1"
    ["to_ping"]=>
    string(0) ""
    ["pinged"]=>
    string(0) ""
    ["post_modified"]=>
    string(19) "2025-06-13 12:48:36"
    ["post_modified_gmt"]=>
    string(19) "2025-06-13 03:48:36"
    ["post_content_filtered"]=>
    string(0) ""
    ["post_parent"]=>
    int(2116)
    ["guid"]=>
    string(35) "http://localhost:5520/?page_id=2118"
    ["menu_order"]=>
    int(0)
    ["post_type"]=>
    string(4) "page"
    ["post_mime_type"]=>
    string(0) ""
    ["comment_count"]=>
    string(1) "0"
    ["filter"]=>
    string(3) "raw"
  }
  [2]=>
  object(WP_Post)#755 (24) {
    ["ID"]=>
    int(2120)
    ["post_author"]=>
    string(1) "1"
    ["post_date"]=>
    string(19) "2025-06-13 12:48:57"
    ["post_date_gmt"]=>
    string(19) "2025-06-13 03:48:57"
    ["post_content"]=>
    string(64) "
テキスト


"
    ["post_title"]=>
    string(23) "テストページ1-1-1"
    ["post_excerpt"]=>
    string(0) ""
    ["post_status"]=>
    string(7) "publish"
    ["comment_status"]=>
    string(6) "closed"
    ["ping_status"]=>
    string(6) "closed"
    ["post_password"]=>
    string(0) ""
    ["post_name"]=>
    string(59) "%e3%83%86%e3%82%b9%e3%83%88%e3%83%9a%e3%83%bc%e3%82%b81-1-1"
    ["to_ping"]=>
    string(0) ""
    ["pinged"]=>
    string(0) ""
    ["post_modified"]=>
    string(19) "2025-06-13 12:48:57"
    ["post_modified_gmt"]=>
    string(19) "2025-06-13 03:48:57"
    ["post_content_filtered"]=>
    string(0) ""
    ["post_parent"]=>
    int(2118)
    ["guid"]=>
    string(35) "http://localhost:5520/?page_id=2120"
    ["menu_order"]=>
    int(0)
    ["post_type"]=>
    string(4) "page"
    ["post_mime_type"]=>
    string(0) ""
    ["comment_count"]=>
    string(1) "0"
    ["filter"]=>
    string(3) "raw"
  }
}
</pre>

### nowPageDateArchiveGet(string $yearFormat="Y", string $monthFormat="Y/n", string $dayFormat="Y/n/j", string $nameKey="name", string $linkKey="link", string $howFar="m"): array

現在のぺージの親に相当する、年別、月別、日別のアーカイブを取得します。

現在のページが投稿ページ、月別、日別のアーカイブの場合に機能し、それ以外は空の配列を返します。

#### 引数について

##### string $yearFormat="Y"

ここには、年別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。

デフォルトでは「Y」です。

##### string $monthFormat="Y/n"

ここには、月別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。

デフォルトでは「Y/n」です。

##### string $dayFormat="Y/n/j"

ここには、日別アーカイブの形式のフォーマット(date関数で使うもの)を渡してください。

デフォルトでは「Y/n/j」です。

##### string $nameKey="name"

ここには、戻り値の配列のキー(日付形式)の名前を渡してください。

デフォルトでは「name」です。

##### string $linkKey="link"

ここには、戻り値の配列のキー(URL)の名前を渡してください。

デフォルトでは「link」です。

##### string $howFar="m"

ここには、現在のページが投稿ページの場合、どこまで取得するかを渡してください。

「y」の場合は年まで、「m」の場合は月まで、「d」の場合は日付までとなります。

#### サンプルコード

```php
$dateArchive = \Ponponumi\PonponcatPostDataget\ParentData::nowPageDateArchiveGet(
    howFar: "d",
    yearFormat: "Y年",
    monthFormat: "Y年n月",
    dayFormat: "Y年n月j日"
);

var_dump($dateArchive);
```

次のように出力されます。

<pre>
array(3) {
  [0]=>
  array(2) {
    ["name"]=>
    string(7) "2025年"
    ["link"]=>
    string(27) "http://localhost:5520/2025/"
  }
  [1]=>
  array(2) {
    ["name"]=>
    string(11) "2025年6月"
    ["link"]=>
    string(30) "http://localhost:5520/2025/06/"
  }
  [2]=>
  array(2) {
    ["name"]=>
    string(16) "2025年6月13日"
    ["link"]=>
    string(33) "http://localhost:5520/2025/06/13/"
  }
}
</pre>

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
