<?php
// OVERVIEW:ユーザーデータを処理

/**
 * ユーザーを作成
 * @param array $data
 * @return bool
 */
function createUser(array $data)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_errno . "\n";
        exit;
    }

    // 新規登録のSQLクエリを作成
    $query = 'INSERT INTO users (email, name, nickname, password) VALUES (?, ?, ?, ?)';

    // プリペアドステートメントに、作成したクエリを登録
    $statement = $mysqli->prepare($query);

    // パスワードをハッシュに変換
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // クエリのプレースホルダ（?の部分）にカラム値を紐づけ
    $statement->bind_param('ssss', $data['email'], $data['name'], $data['nickname'], $data['password']);

    // クエリを実行
    $response = $statement->execute();

    // 実行に失敗した場合->エラー表示
    if ($response === false) {
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    // DB接続を解放
    $statement->close();
    $mysqli->close();

    return $response;
}

/**
 * ユーザー情報取得：ログインチェック
 * @param string $email
 * @param string $password
 * @return array|false
 */
function findUserAndCheckPassword(string $email, string $password)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_errno . "\n";
        exit;
    }

    // 入力値をエスケープ
    $email = $mysqli->real_escape_string($email);

    // SQLクエリを作成
    // TIPS:外部からのリクエストは何が入ってくるかわからないので、必ず、エスケープしたものをクオートで囲む。
    $query = 'SELECT * FROM users WHERE email = "' . $email . '"';

    // クエリ実行
    $result = $mysqli->query($query);

    // クエリ実行に失敗した場合->return
    if (!$result) {
        // MySQL処理中にエラー発生
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
        $mysqli->close();
        return false;
    }

    // ユーザー情報を取得
    $user = $result->fetch_array(MYSQLI_ASSOC);
    // ユーザーが存在しない場合->return
    if (!$user) {
        $mysqli->close();
        return false;
    }

    // パスワードチェック、不一致の場合->return
    if (!password_verify($password, $user['password'])) {
        $mysqli->close();
        return false;
    }

    // DB接続を解放
    $mysqli->close();

    return $user;
}

/**
 * ユーザーを1件取得
 * @param int $user_id 取得するユーザーid
 * @param int $login_user_id 自分のユーザーid（ログインユーザー）
 * @return array|false
 */
function findUser(int $user_id, int $login_user_id = null)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_errno . "\n";
        exit;
    }

    // エスケープ（SQLインジェクション対策）
    $user_id = $mysqli->real_escape_string($user_id);
    $login_user_id = $mysqli->real_escape_string($login_user_id);

    // SQLクエリを作成（検索）
    $query = <<<SQL
        SELECT U.id,
            U.name,
            U.nickname,
            U.email,
            U.image_name,
            -- フォロー中の数
            (
                SELECT COUNT(1)
                FROM follows
                WHERE status = 'active'
                    AND follow_user_id = U.id
            ) AS follow_user_count,
            -- フォロワーの数
            (
                SELECT COUNT(1)
                FROM follows
                WHERE status = 'active'
                    AND followed_user_id = U.id
            ) AS followed_user_count,
            -- ログインユーザーがフォローしている場合、フォローIDが入る
            F.id AS follow_id
        FROM users AS U
            LEFT JOIN follows AS F ON F.status = 'active'
            AND F.followed_user_id = '$user_id'
            AND F.follow_user_id = '$login_user_id'
        WHERE U.status = 'active'
            AND U.id = '$user_id' 
    SQL;

    // 戻り値を作成
    // クエリを実行し、SQLエラーでない場合
    if ($result = $mysqli->query($query)) {
        // 戻り値用の変数にセット：ユーザー情報1件
        $response = $result->fetch_array(MYSQLI_ASSOC);
    } else {
        // 戻り値用の変数にセット：失敗
        $response = false;
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    // 後処理
    // DB接続を開放
    $mysqli->close();

    return $response;
}

?>