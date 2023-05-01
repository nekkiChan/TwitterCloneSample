<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Views/img/logo-twitterblue.svg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../Views/css/style.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"
        defer></script>
    <!-- いいね！JS -->
    <script src="../Views/js/likes.js" defer></script>

    <title>プロフィール画面 / Twitterクローン</title>
    <meta name="description" content="プロフィール画面です">
</head>

<body class="home profile text-center">
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link"><img
                                src="../Views/img/logo-twitterblue.svg" alt="" class="icon"></a>
                    </li>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-home.svg"
                                alt=""></a>
                    </li>
                    <li class="nav-item"><a href="search.php" class="nav-link"><img src="../Views/img/icon-search.svg"
                                alt=""></a>
                    </li>
                    <li class="nav-item"><a href="notification.php" class="nav-link"><img
                                src="../Views/img/icon-notification.svg" alt=""></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img src="../Views/img/icon-profile.svg"
                                alt=""></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img
                                src="../Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img src="../Views/img_uploaded/user/sample-person.jpg" alt=""
                            class="js-popover" data-bs-container="body" data-bs-toggle="popover"
                            data-bs-placement="right" data-bs-html="true"
                            data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="main-header">
                <h1>太郎</h1>
            </div>

            <!-- プロフィールエリア -->
            <div class="profile-area">
                <div class="top">
                    <div class="user">
                        <img src="../Views/img_uploaded/user/sample-person.jpg" alt="">
                    </div>
                    <button class="btn btn-reverse btn-sm">プロフィール編集</button>

                    <div class="name">太郎</div>
                    <div class="text-muted">@taro</div>

                    <div class="follow-follower">
                        <div class="follow-count">1</div>
                        <div class="follow-text">フォロー</div>
                        <div class="follow-count">1</div>
                        <div class="follow-text">フォロワー</div>
                    </div>

                    <!-- 仕切りエリア -->
                    <div class="ditch"></div>

                    <!-- つぶやき一覧エリア -->
                </div>
            </div>
            <script src="../Views/js/markup_ballon.js"></script>
</body>

</html>