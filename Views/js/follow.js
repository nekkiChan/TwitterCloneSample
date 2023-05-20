// OVERVIEW:フォロー用のJavaScript

$(function () {
    $('.js-follow').click(
        function () {
            /** クリックした要素 */
            const this_obj = $(this);
            /** データ属性'followed_user_id'のオブジェクト */
            const followed_user_id = $(this).data('followed-user-id');
            /** データ属性'follow_id'のオブジェクト */
            const follow_id = $(this).data('follow-id');

            // MyLib:begin
            /** データ属性'js-follow_follower'のオブジェクト */
            const follow_obj = $(this).parent().parent().find('.js-follow-follower');
            /** データ属性'js-followed-count'のオブジェクト */
            const followed_user_count_obj = follow_obj.find('.js-followed-count');
            /** フォロワー数（表示用） */
            let followed_count = Number(followed_user_count_obj.html());
            // MyLib:end

            if (follow_id) {
                // フォロー取り消し
                $.ajax({
                    url: 'follow.php',
                    type: 'POST',
                    data: {
                        'follow_id': follow_id
                    },
                    timeout: 10000
                })
                    // 取り消し成功
                    .done(() => {
                        // フォローボタンを白にする
                        this_obj.addClass('btn-reverse');
                        // フォローボタンの文言変更
                        this_obj.text('フォローする');
                        // MyLib:begin
                        // フォロワー数
                        followed_count--;
                        followed_user_count_obj.html(followed_count);
                        // MyLib:end
                        // フォローIDを削除
                        this_obj.data('follow-id', null);
                    })
                    // 取り消し失敗
                    .fail(() => {
                        alert('処理中にエラーが発生しました。');
                        console.log(data);
                    });
            } else {
                // フォローする
                $.ajax({
                    url: 'follow.php',
                    type: 'POST',
                    data: {
                        'followed_user_id': followed_user_id
                    },
                    timeout: 10000
                })
                    // フォロー成功
                    .done((data) => {
                        // フォローボタンを青にする
                        this_obj.removeClass('btn-reverse');
                        // フォローボタンの文言変更
                        this_obj.text('フォローを外す');
                        // MyLib:begin
                        // フォロワー数
                        followed_count++;
                        followed_user_count_obj.html(followed_count);
                        // MyLib:end
                        // フォローIDを付与
                        this_obj.data('follow-id', data['follow_id']);
                    })
                    // 取り消し失敗
                    .fail(() => {
                        alert('処理中にエラーが発生しました。');
                        console.log(data);
                    });
            }
        })
});