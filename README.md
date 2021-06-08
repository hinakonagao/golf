# Golf Score Share （個人開発アプリ）
ゴルフコースを回る際、一緒に回るメンバーが各々のスマホから共有のスコアカードを見たり、スコアを書き込めるアプリです。<br>
http://golf-score-share.herokuapp.com/golf <br>
※スマホもしくはタブレットでご利用ください。
<br><br>  

## DEMO
coming soon ...
<br><br>
    

## アプリ概要
Web上でスコアカードを簡単に共有し、組のメンバーの誰でもスコアを書き込むことができます。

通常はコースを回る間、各々でスコアカードを付けておき、終了後みんなでスコアを確認し合います。  
個人でスコアカードを保存するスマホアプリや、同じスマホアプリをダウンロードしている人同士でスコアカードを共有できるサービスはありますが、誰でも準備不要ですぐに使えるサービスは見つかりませんでした。  
この「Golf score share」であれば、コースを回るその時にwebページを開くだけで、誰でも簡単に使うことが出来ます。
<br><br>

## 開発のきっかけ
・私自身ゴルフが好きでコースを回ることがあり、こんなサービスが欲しいなと思っていた。<br>
・ゴルフ仲間にも聞いてみたところ、「機能豊富なスマホアプリよりも、登録など不要で気軽に使えるシンプルなスコアカードが欲しい。」という声を複数人から聞くことができた。<br>
・プレー中にスコアカードを共有できれば、更に便利で面白いのではないかと考えた。
<br><br>

## 使い方
### スコアカード作成者
1. start a new gameをタップします。
2. ゲーム名・パスワードを決め、start a new gameをタップしてスコアカードを作成します。<br>
※過去に使われているゲーム名は使えません。


### スコアカードへの参加者
1. join the game をタップします。
2. 作成者が登録したのと同じゲーム名・パスワードを入力し、join the gameをタップしてスコアカードに参加します。<br>
※ゲーム名・パスワードの一致が確認できなけれなエラーになります。


### スコアカードの使い方
・作成者・参加者の誰でも、スコアカードに書き込むことが出来ます。<br>
・スコアカードに書き込んだ時点で、自動的にデータは更新されます。他の人が更新した内容を自分の画面に反映させる為には、updateボタンを押してください。<br>
(例)Aさんがスコアカードにhole1のスコアを入力。→Bさんが自分のスマホのupdateボタンを押すと、Aさんが入力したスコアがBさんの画面にも反映する。
<br><br>

## 使用技術
・Laravel 8.38.0 
・PHP 7.3.11
・jQuery 3.6.0
・Ajax
・MySQL
<br><br>  

## ER図
https://github.com/hinakonagao/golf-score-share/issues/3#issue-906132626

## 工夫した点
・Laravelのルーティング<br>
スコアカードのビューを表示する際、スコアカードの作成者と参加者が同じルートパラメーターや変数を持つようにする為に、作成者と参加者の双方が同じコントローラーのメソッドを通るようにルーティングを行った。

・スコアカードはforeachを使って表示<br>
スコアカードのビューは、テーブルのデータをforeachで表示し、CSSで行列を入れ替えて表示した。

・データ保存の際の通信削減<br>
当初は、スコアカードの値をひとつ変更する毎に、スコアカードのカラム全てについてデータベースの値を更新する処理を行なっていた。<br>
そこでdata属性を指定し、jQueryで変更のあったカラムのみを取得することで、変更のあったカラムのみデータベースを更新する処理を可能にした。

・Ajaxを使用した非同期通信によるデータ保存<br>
スコアカードへ入力した際は、Ajaxでデータベースへデータを保存するようにした。<br>
現在は入力した人以外の画面に変更を反映させる為にはリロードする必要があるが、ゆくゆくはリロードしなくとも画面が更新されるようにしたい。
<br><br>

## 今後の改修予定箇所
・RoomPlayerテーブルにTotalカラムを追加する<br>
現在スコアのTotalはhole1~18の合計値をリロードの度に計算しているので、テーブルにTotalカラムを作っておくことで計算処理をなくす。

・updateボタンを押さなくても、データが更新された際はビューに反映するようにする<br>
現在Ajaxを使って非同期通信でデータの保存を行っているものの、更新されたデータを別の人の画面に反映するにはリロードする必要がある。

・コンペ機能を追加する（利用者からの意見より。）<br>
現在のGolf Score Shareは一緒にコースを回るメンバーでスコアカードを共有するという内容だが、<br>
コンペを作成→コンペの中に複数のスコアカードを作成→コンペ参加者は別の組のスコアカード進捗も見られる<br>
という機能を追加したい。

・ログイン・ユーザー登録機能を追加する（利用者からの意見より。）<br>
現在の仕様では、過去のスコアカードを見るには再度同じゲーム名・パスワードでスコアカードに入る必要がある。<br>
ログイン・ユーザー登録をすることにより、自分がプレーした過去のスコアカードを確認できるようにしたい。

・スコアカードを半分ずつ拡大表示できるようにする。（利用者からの意見より。）<br>
文字が小さく見づらいという難点がある。<br>
スコアカードを２ページに分け、ページを切り替えて表示できるSPAの構成にしたい。
<br><br>

## アプリ利用者から挙げられた改善案
・複数組でラウンドを回っている際、他の組のスコア進捗も見られると盛り上がる。（友人）<br>
・過去のスコアカードを簡単に見られるようになれば、より本格的に、毎回使うアプリになると思う。（友人）<br>
・スコアカードの字が小さい。（祖母）
