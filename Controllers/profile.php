<?php
// OVERVIEW:プロフィールコントローラー

// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ユーザーデータ操作モデルを読み込む
include_once '../Models/users.php';
// ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

// ログインチェック
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}

// ユーザーの情報を変更
// ニックネームとユーザー名とメールアドレスが入力されている場合
if (true) {
}

// 表示するユーザーIDを取得（デフォルトはログインユーザー）
// URLにuser_idがある場合->それを対象ユーザーにする
$requested_user_id = $user['id'];
if (isset($_GET['user_id'])) {
    $requested_user_id = $_GET['user_id'];
}

// 表示用の変数
$view_user = $user;
// プロフィール詳細
$view_requested_user = findUser($requested_user_id, $user['id']);
// ツイート一覧
$view_tweets = findTweets($user, null, [$requested_user_id]);

// 画面表示
include_once '../Views/profile.php';

?>