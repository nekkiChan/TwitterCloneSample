<?php
// OVERVIEW:変数の説明

// ユーザー関連
/** @var array|bool ユーザー情報 
 *  id: ユーザーID
 *  status: ユーザーのステータス
 *  nickname: ユーザーネーム
 *  name: アカウント名
 *  email: メールアドレス
 *  password: パスワード
 *  image_name: プロフィール画像名
 *  created_at: アカウント作成日
 *  updated_at: アップデート日
 */
$user = false;
/** @var array|bool ユーザー情報（表示用）
 *  id: ユーザーID
 *  status: ユーザーのステータス
 *  nickname: ユーザーネーム
 *  name: アカウント名
 *  email: メールアドレス
 *  password: パスワード
 *  image_name: プロフィール画像名
 *  created_at: アカウント作成日
 *  updated_at: アップデート日
 */
$view_user = false;
/** @var string|bool ユーザーID（初期値は自分のユーザーID） */
$requested_user_id = false;
/** @var array|bool プロフィール詳細（表示用）
 *  id: ユーザーID（初期値は自分のユーザーID）
 *  name: アカウント名
 *  nickname: ユーザーネーム
 *  email: メールアドレス
 *  image_name: プロフィール画像名
 *  follow_user_count: フォロー数
 *  followed_user_count: フォロワー数
 *  follow_id: フォローしているか
 */
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

// ログイン関連
/** @var bool ログイン結果 */
$try_login_result = false;
/** @var bool ログイン結果（表示用） */
$view_try_login_result = false;

// フォロー関連
/** @var int|bool|null フォローID */
$follow_id = false;
/** @var array|bool 自分がフォローしているユーザーID一覧 */
$following_user_ids = false;

// 通知関連
/** 
 * @var array|bool 通知一覧情報
 * notification_id: 通知ID
 * notification_message: 通知メッセージ
 * user_name: アカウント名
 * user_nickname: ユーザー名
 * user_image_name: プロフィール画像名
 */
$view_notifications = false;
/** 
 * @var array|bool 通知情報
 * notification_id: 通知ID
 * notification_message: 通知メッセージ
 * user_name: アカウント名
 * user_nickname: ユーザー名
 * user_image_name: プロフィール画像名
 */
$view_notification = false;

?>