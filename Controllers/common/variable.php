<?php
// OVERVIEW:変数の説明

// ユーザー関連
/** ユーザー情報 */
$user = null;
/** @var array ユーザー情報（表示用） */
$view_user = null;

// ツイート関連
/**
 *  @var array ツイート情報の配列（表示用）
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
$view_tweets = null;
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
$view_tweet = null;
/** キーワード情報（表示用） */
$view_keyword = null;

// システム関連
/** @var bool ログイン結果 */
$try_login_result = null;
/** @var bool ログイン結果（表示用） */
$view_try_login_result = null;

?>