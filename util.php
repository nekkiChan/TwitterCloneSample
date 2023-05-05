<?php
// OVERVIEW:便利な関数

/**
 * 画像ファイル名から画像のURLを生成する
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
    /** 1970-01-01 00:00:00 から $datetime までの 経過秒数 */
    $unix = strtotime($datetime);
    /** 1970-01-01 00:00:00 から 現時間 までの 経過秒数 */
    $now = time();
    /** $datetime から 現時間 までの 秒数差 */
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