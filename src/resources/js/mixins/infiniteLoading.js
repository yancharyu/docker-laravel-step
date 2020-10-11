export default {
  methods: {
    /**
     * 現在既に取得しているstepListからID値だけ抜き出して配列に格納
     *
     * @return {number} 現在取得しているSTEPのIDの配列
     */

    getFetchedIdList(array) {
      // 最初の読み込みなどstepListがまだ空の場合は空の配列を返す
      if (!array.length) {
        return [];
      }

      const fetchedIdList = [];
      array.forEach(val => {
        fetchedIdList.push(val.id);
      });
      return fetchedIdList;
    },

    /**
     * infiniteLoadingの処理
     * @param {array} array ID検索する配列
     * @param {string} url APIで通信するさきのURL
     * @param {function} func 通信結果を適応させる関数
     * @param {object} $state infiniteLoadingを操作するオブジェクト
     */
    async infiniteLoading(array, url, func, $state) {
      if (this.loading) return; // 読み込み中ならスキップ
      this.loading = true;

      const fetchedIdList = this.getFetchedIdList(array);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let results = [];
      try {
        const res = await axios.get(`/api/${url}`, { params });
        results = res.data;
        if (results.length) {
          func(results);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // ロード終了
        this.loading = false;
      }
    },
  },
};
