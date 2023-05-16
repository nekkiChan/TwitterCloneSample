// OVERVIEW:"いいね！機能の実装"

$(
    /** 
     * いいね！がクリックされた時に実行する関数
     * @return {void}
     */
    function () {
        $('.js-like').click(
            /**
             * いいね！に関するデータを変更する関数
             * @return {void}
             */
            function () {
                /** クラス属性'js-like'のオブジェクト */
                const this_obj = $(this);
                /** データ属性'tweet_id'のオブジェクト */
                const tweet_id = $(this).data('tweet-id');
                /** データ属性'like-id'のオブジェクト */
                const like_id = $(this).data('like-id');
                /** クラス属性'js-like-count'のオブジェクト */
                const like_count_obj = $(this).parent().find('.js-like-count');
                /** いいね！の数 */
                let like_count = Number(like_count_obj.html());

                if (like_id) {
                    // いいね！取り消し
                    // 非同期通信
                    $.ajax({
                        url: 'like.php',
                        type: 'POST',
                        data: {
                            'like_id': like_id
                        },
                        timeout: 10000
                    })

                        // 取り消し成功
                        .done(() => {
                            // いいね！カウントを減らす
                            like_count--;
                            like_count_obj.html(like_count);
                            this_obj.data('like-id', null);

                            //いいね！ボタンの色をグレーに変更
                            $(this).find('img').attr('src', '../Views/img/icon-heart.svg');
                        })

                        // 取り消し失敗
                        .fail((data) => {
                            alert('処理中にエラーが発生しました。');
                            console.log(data);
                        });

                } else {
                    // いいね！付与
                    // 非同期通信
                    $.ajax({
                        url: 'like.php',
                        type: 'POST',
                        data: {
                            'tweet_id': tweet_id
                        },
                        timeout: 10000
                    })

                        // いいね！が成功
                        .done((data) => {
                            // いいね！カウントを増やす
                            like_count++;
                            like_count_obj.html(like_count);
                            this_obj.data('like-id', data['like_id']);

                            // いいね！ボタンの色を青に変更
                            $(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');
                        })

                        // いいね！失敗
                        .fail((data) => {
                            alert('処理中にエラーが発生しました。');
                            console.log(data);
                        });
                }
            });
    });