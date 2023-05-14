<?php
// OVERVIEW:ポストコントローラー

// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

// ログインチェック
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location:' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}

// ツイートがある場合
if (isset($_POST['body'])) {
    $image_name = null;
    if (isset($_FILES['name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = null;
        // TO-DO:画像をアップロード
    }

    $data = [
        'user_id' => $user['id'],
        'body' => $_POST['body'],
        'image_name' => $image_name,
    ];

    // つぶやき投稿
    if (true) {
        // ホーム画面に遷移
        header('Location: ' . HOME_URL . 'Controllers/home.php');
        exit;
    }
}

/** @var array ユーザー情報  */
$view_user = $user;

// 画面表示
include_once '../Views/post.php';

?>