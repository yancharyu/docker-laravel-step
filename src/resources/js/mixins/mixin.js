export default {
  methods: {
    /**
     * 現在既に取得しているstepListからID値だけ抜き出して配列に格納
     *
     * @param {array} array ステップリスト
     * @return {number} 現在取得しているSTEPのIDの配列
     */
    getFetchedIdList(array) {
      // 最初の読み込みなどstepListがまだ空の場合は空の配列を返す
      if (!array.length) {
        return [];
      }

      const fetchedIdList = [];
      array.forEach(item => {
        fetchedIdList.push(item.id);
      });
      return fetchedIdList;
    },

    /**
     * 押された時にサイトのトップへ遷移する
     *
     * @return {boolean}
     */
    goTop() {
      $('body,html').animate(
        {
          scrollTop: 0,
        },
        300,
      );
      return false;
    },

    /**
     *
     * @param {object} user ユーザーオブジェクト
     * @return ユーザーの写真があればその写真のパスを、なければNO_IMGを返す
     */
    getProfilePic(user) {
      if (user.pic) {
        return user.pic;
      }
      return '/images/NO_IMG.png';
    },

    /**
     * 文字列を20文字で切って...と連結して出力する関数
     * @param {string} str 切り取る文字列
     * @param {int} len=20 何文字目で切り取るか
     * @return {string} 文字列が指定した文字数以内なら文字列をそのまま返す
     *   指定した文字数以上なら指定した文字数で切り取り...とつなげて返す
     */
    convertedString(str, len = 20) {
      // 20文字以内の場合はそのまま出力
      if (str.length <= len) {
        return str;
      }
      return `${str.substring(0, len)}...`;
    },
  },
};
