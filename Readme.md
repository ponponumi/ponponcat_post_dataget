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

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
