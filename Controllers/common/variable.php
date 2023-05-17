<?php
// OVERVIEW:変数の説明

// ユーザー関連
/** @var array|bool ユーザー情報 */
$user = false;
/** @var array|bool ユーザー情報（表示用） */
$view_user = false;
/** @var string|bool ユーザーID（初期値は自分のユーザーID） */
$requested_user_id = false;
/** @var array|bool プロフィール詳細（表示用） */
$view_requested_user = false;


// ツイート関連
/**
 *  @var array|bool ツイート情報の配列（表示用）
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
$view_tweets = false;
/**
 *  @var array|bool ツイート情報（表示用）
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
$view_tweet = false;
/** @var array|bool キーワード情報（表示用） */
$view_keyword = false;

// システム関連
/** @var bool ログイン結果 */
$try_login_result = false;
/** @var bool ログイン結果（表示用） */
$view_try_login_result = false;

?>