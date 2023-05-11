// OVERVIEW:"吹き出しマーク機能の実装"

document.addEventListener('DOMContentLoaded',
    /**
     * DOMツリーの構築が完了した時に、実行される関数。
     * 対象をクリックすると、オブジェクトがポップアップする。
     * @return {void}
     */
    function () {
        $('.js-popover').popover();
    }, false
);