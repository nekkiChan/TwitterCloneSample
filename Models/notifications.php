<?php
// OVERVIEW:通知データを処理

/**
 * 通知を作成
 * @param array<received_user_id:int,sent_user_id:int,message:string> $data 
 * $data = [
 * 'received_user_id' => 受信側のユーザーID,
 * 'sent_user_id' => 送信側のユーザーID,
 * 'message' => メッセージ,
 * ]
 * @return int|false notifications.id | false
 */
function createNotification(array $data)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_errno . "\n";
        exit;
    }

    // SQLクエリを作成
    $query = 'INSERT INTO notifications (received_user_id, sent_user_id, message) VALUES (?, ?, ?)';
    $statement = $mysqli->prepare($query);

    // プレースホルダに値をセット
    $statement->bind_param('iis', $data['received_user_id'], $data['sent_user_id'], $data['message']);

    // 戻り値を作成
    // クエリを実行し、SQLエラー出ない場合
    if ($statement->execute()) {
        // 戻り値用の変数にセット：インサートID（notifications.id）
        $response = $mysqli->insert_id;
    } else {
        // 戻り値用の変数にセット：失敗
        $response = false;
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    // 後処理
    // DB接続を開放
    $statement->close();
    $mysqli->close();

    return $response;
}

/**
 * 通知の一覧を取得
 * @param int $user_id ユーザーID
 * @return array<notification_id:int,notification_message:string,user_name:string,user_nickname:string,user_image_name:string>|false
 * 
 * array = [
 * 'notification_id' => 通知ID,
 * 'notification_message' => 通知メッセージ,
 * 'user_name' => アカウント名,
 * 'user_nickname' => ユーザー名,
 * 'user_image_name' => プロフィール画像名,
 * ] | false
 */
function findNotifications(string $user_id)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_errno . "\n";
        exit;
    }

    // 入力値をエスケープ
    $user_id = $mysqli->real_escape_string($user_id);

    // SQLクエリを作成
    $query = <<<SQL
        SELECT -- 通知
            N.id AS notification_id,
            N.message AS notification_message,
            -- ユーザー
            U.name AS user_name,
            U.nickname AS user_nickname,
            U.image_name AS user_image_name
        FROM notifications AS N
            JOIN users AS U ON U.id = N.sent_user_id
            AND U.status = 'active'
        WHERE N.status = 'active'
            AND N.received_user_id = '$user_id'
        ORDER BY N.created_at DESC
        LIMIT 50
    SQL;

    // 戻り値を作成
    // クエリを実行し、SQLエラー出ない場合
    if ($result = $mysqli->query($query)) {
        // 全件取得
        $notifications = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $notifications = false;
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    // DB接続を解放
    $mysqli->close();

    return $notifications;
}

?>