<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>会員登録画面 / Twitterクローン</title>
    <meta name="description" content="会員登録画面です">
</head>

<!--
    Bootstrapのクラス
    text-center: 'text-align:center;'と同じ。
    w-100: 'width:100%;'と同じ。
    btn-lg: 大きなボタン。
    mt-3: 'margin-top:1rem;'と同じ。
    mb-2: 'margin-bottom:0.5rem;'と同じ。
    text-muted: 文字を灰色にする。
-->

<body class="signup text-center">
    <main class="form-signup">
        <form action="sign-up.php" method="post">
            <img src="../Views/img/logo-white.svg" alt="" class="logo-white">
            <h1>アカウントを作る</h1>
            <input type="text" class="form-control" name="nickname" placeholder="ニックネーム" maxlength="50" required
                autofocus>
            <input type="text" class="form-control" name="name" placeholder="ユーザー名、例）techiis02" maxlength="50" required>
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" maxlength="254" required>
            <input type="password" class="form-control" name="password" placeholder="パスワード" minlength="4"
                maxlength="128" required>
            <button class="w-100 btn btn-lg" type="submit">登録する</button>
            <p class="mt-3 mb-2"><a href="sign-in.php">ログインする</a></p>
            <p class="mt-2 mb-3 text-muted">&copy; 2023</p>
        </form>
    </main>
    <?php include_once('../Views/common/foot.php'); ?>
</body>

</html>