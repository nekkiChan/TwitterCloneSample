<?php
// エラー表示あり
ini_set('display_errors', 1);
// 日本時間にする
date_default_timezone_set('Asia/Tokyo');
// URL/ディレクトリ設定
define('HOME_URL', '/TwitterClone/');

// ツイート一覧
$view_tweets = [
    [
        'user_id' => 1,
        'user_name' => 'taro',
        'user_nickname' => '太郎',
        'user_image_name' => 'sample-person.jpg',
        'tweet_body' => '今プログラミングをしています',
        'tweet_image_name' => null,
        'tweet_created_at' => '2021-03-15 14:00:00',
        'like_id' => null,
        'like_count' => 0,
    ],
    [
        'user_id' => 2,
        'user_name' => 'jiro',
        'user_nickname' => '次郎',
        'user_image_name' => null,
        'tweet_body' => 'コワーキングスペースをオープンしました！',
        'tweet_image_name' => 'sample-post.jpg',
        'tweet_created_at' => '2021-03-14 14:00:00',
        'like_id' => 1,
        'like_count' => 1,
    ],
];

// 便利な関数
/**
 * 画像ファイル名から画像のURLを生成する
 * 
 * @param string $name 画像ファイル名
 * @param string $type user | tweet
 * @return string 
 */
function buildImagePath(string $name = null, string $type)
{
    if ($type === 'user' && !isset($name)) {
        return HOME_URL . 'Views/img/icon-default-user.svg';
    }

    return HOME_URL . 'Views/img_uploaded/' . $type . '/' . htmlspecialchars($name);
}

/**
 * 指定した日時からどれだけ経過したかを取得
 * @param string $datetime 日時
 * @return string
 */
function convertToDayTimeAgo(string $datetime)
{
    // $unix:1970-01-01 00:00:00から$datetimeまでの経過秒数
    $unix = strtotime($datetime);
    // $now:1970-01-01 00:00:00から現時間までの経過秒数
    $now = time();
    $diff_sec = $now - $unix;

    // $unixと$nowの年月日時分が同じだった場合
    if ($diff_sec < 60) {
        $time = $diff_sec;
        $unit = "秒前";
        // $unixと$nowの年月日時が同じだった場合
    } else if ($diff_sec < 60 * 60) {
        $time = $diff_sec / 60;
        $unit = "分前";
        // $unixと$nowの年月日が同じだった場合
    } else if ($diff_sec < 60 * 60 * 24) {
        $time = $diff_sec / (60 * 60);
        $unit = "時間前";
    } else if ($diff_sec < 60 * 60 * 24 * 32) {
        $time = $diff_sec / (60 * 60 * 24);
        $unit = '日前';
    } else {

        if (date('Y') !== date('Y', $unix)) {
            // $unixと$nowの年が異なっていた場合
            $time = date('Y年n月j日', $unix);
        } else {
            // $unixと$nowの年が同じだった場合
            $time = date('n月j日', $unix);
        }
        return $time;
    }

    return (int) $time . $unit;
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo HOME_URL; ?>Views/css/style.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"
        defer></script>
    <!-- いいね!JS -->
    <script src="<?php echo HOME_URL; ?>Views/js/likes.js" defer></script>

    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>

<body class="home">
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a>
                    </li>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/icon-home.svg" alt=""></a>
                    </li>
                    <li class="nav-item"><a href="search.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/icon-search.svg" alt=""></a>
                    </li>
                    <li class="nav-item"><a href="notification.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/icon-notification.svg" alt=""></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/icon-profile.svg" alt=""></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img
                                src="<?php echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt=""
                                class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img
                            src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt=""
                            class="js-popover" data-bs-container="body" data-bs-toggle="popover"
                            data-bs-placement="right" data-bs-html="true"
                            data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
            </div>

            <!-- つぶやき投稿エリア -->
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                </div>
                <div class="input-area">
                    <form action="post.php" method="post" enctype="multipart/form-data">
                        <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0">
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            <button type="submit" class="btn">つぶやく</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 仕切りエリア -->
            <div class="ditch"></div>

            <!-- つぶやき一覧エリア -->
            <?php if (empty($view_tweets)): ?>
                <p class="p-3">ツイートがありません</p>
            <?php else: ?>
                <?php foreach ($view_tweets as $view_tweet): ?>
                    <div class="tweet-list">
                        <div class="tweet">
                            <div class="user">
                                <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>">
                                    <img src="<?php echo buildImagePath($view_tweet['user_image_name'], 'user'); ?>" alt="">
                                </a>
                            </div>
                            <div class="content">
                                <div class="name">
                                    <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>">
                                        <span class="nickname">
                                            <?php echo htmlspecialchars($view_tweet['user_nickname']); ?>
                                        </span>
                                        <span class="user-name">
                                            @
                                            <?php echo htmlspecialchars($view_tweet['user_name']); ?> ・
                                            <?php echo convertToDayTimeAgo($view_tweet['tweet_created_at']); ?>
                                        </span>
                                    </a>
                                </div>
                                <p>
                                    <?php echo htmlspecialchars($view_tweet['tweet_body']); ?>
                                </p>

                                <?php if (isset($view_tweet['tweet_image_name'])): ?>
                                    <img src="<?php echo buildImagePath($view_tweet['tweet_image_name'], 'tweet'); ?>" alt=""
                                        class="post-image">
                                <?php endif; ?>

                                <div class="icon-list">
                                    <div class="like js-like"
                                        data-like-id="<?php echo htmlspecialchars($view_tweet['like_id']); ?>">
                                        <?php
                                        if (isset($view_tweet['like_id'])) {
                                            // いいね！している場合、青のハートを表示
                                            echo '<img src="' . HOME_URL . 'Views/img/icon-heart-twitterblue.svg" alt="">';
                                        } else {
                                            // いいね！していない場合、グレーのハートを表示
                                            echo '<img src="' . HOME_URL . 'Views/img/icon-heart.svg" alt="">';
                                        }
                                        ?>
                                    </div>
                                    <div class="like-count js-like-count">
                                        <?php echo htmlspecialchars($view_tweet['like_count']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="<?php echo HOME_URL; ?>Views/js/markup_ballon.js"></script>
</body>

</html>