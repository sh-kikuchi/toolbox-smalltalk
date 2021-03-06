
#  smalltalk

## 1. アプリ概要/開発目的
- アプリ内容：グループチャットアプリ
  - チャンネルを作って、その中でお茶の間トークを楽しむことが出来る。
  - 「ひとりごと」という個人用のトークルームも用意（メモ帳としても使える）

- 開発目的
  - 「toolbox」シリーズと題し、自分のお道具箱のようなアプリを複数制作したい。
  - Slackライクなトークルームを自分で1から作ってみたい。
  - 「多」対「多」、つまり1人のユーザーが多くのグループに属することが出来る且つ1つのグループが多くのユーザーを抱えることが出来るというデータベースにおけるリレーションを体験すること。

## 2. スキルセット/開発環境
### ■ フロントエンド/マークアップ
- HTML5
- CSS3
- JavaScript
- jQuery

### ■ サーバーサイド
- Laravel6(開発当初) ← PHP7

  ※現在（2022/03/20時点）<br>
  - Laravel9
  - Laravel/ui 3.*
  - PHP8

### ■ 開発ツール/環境
- GitHub（バージョン管理）
- Slack（進捗管理）
- VSCode（エディタ）
- Homestead（仮想環境）
- Windows（OS）

### ■ データベース
- MySQL

### ■ デプロイ
- Heroku

## 3. 機能一覧
- 認証
  - ログイン
  - 新規登録
  - ログアウト

- チャンネル（グループ作成）
  - チャンネル作成
  - チャンネル検索・参加
  - チャンネル退会

- トークルーム
  - トークの追加・表示・編集・削除（CRUD）
  - トークルームの削除（管理者のみ）

- トークルームの参加者リスト
  - 一般・管理者の各権限の付与
    - 管理者はチャンネルの削除が可能
    - 管理者は必ず1人設置（デフォルトはチャンネル作成者）

- プロフィール
  - プロフィール更新（名前・メールアドレス・パスワード・コメント）

- ひとりごと（個人のtodoリストやメモ帳に使える）
  - コメントの追加・表示・編集・削除

## 4. 画面遷移図
![routes](/public/images/smalltalk.png)
## 5. データベース（ER図）
![routes](/public/images/smalltalk.drawio.png)
## 6. 備考
- もともとVer1として、Twitterのようなチャットアプリを制作していたが、同プロジェクト内でグループチャットアプリとして作り替えた。
