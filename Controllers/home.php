<?php
// OVERVIEW:ホームコントローラー

// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

// ログインチェック
/** ユーザー情報 */
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}

/** @var array ユーザー情報（表示用） */
$view_user = $user;
// ツイート一覧
// TO-DO:モデルから取得する
/**
 *  @var array ツイート情報（表示用）
 *  tweet_id: ツイートid
 *  tweet_status: ツイートのステータス
 *  tweet_body: ツイート本文
 *  tweet_image_name: ツイート画像名
 *  tweet_created_at: 投稿時間
 *  user_id: ユーザーID
 *  user_name: アカウント名
 *  user_nickname: ユーザーネーム
 *  user_image_name: プロフィール画像名
 *  like_id: いいね！しているか（していない場合はnullとなる）
 *  like_count: いいね！されている数
 */
$view_tweets = findTweets($user);

// 画面表示
include_once '../Views/home.php';

?>