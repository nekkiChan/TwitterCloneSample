// OVERVIEW:"いいね！機能の実装"

$(
    /** 
     * いいね！がクリックされた時に実行する関数
     */
    function () {
        $('.js-like').click(
            /**
             * いいね！に関するデータを変更する関数
             */
            function () {
                /** クラス属性'js-like'のオブジェクト */
                const this_obj = $(this);
                /** データ属性'like-id' */
                const like_id = $(this).data('like-id');
                /** クラス属性'js-like-count'のオブジェクト */
                const like_count_obj = $(this).parent().find('.js-like-count');
                /** いいね！の数 */
                let like_count = Number(like_count_obj.html());

                if (like_id) {
                    // いいね！取り消し
                    // いいね！カウントを減らす
                    like_count--;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', null);

                    //いいね！ボタンの色をグレーに変更
                    $(this).find('img').attr('src', '../Views/img/icon-heart.svg');
                } else {
                    // いいね！付与
                    // いいね！カウントを増やす
                    like_count++;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', true);

                    // いいね！ボタンの色を青に変更
                    $(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');
                }
            });
    });