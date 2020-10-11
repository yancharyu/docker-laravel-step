<template>
  <div class="p-mypage__main p-mypage__main--relations">
    <h1 class="p-mypage__title">{{ $t('フォロー中') }}</h1>
    <a v-for="user in getFollowings" :key="user.id" class="c-avatar p-mypage__avatar" @click="locationProfile(user.id)">
      <img :src="getProfilePic(user)" class="c-avatar__pic" />
      <span class="c-avatar__name">{{ user.name }}</span>
    </a>
    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('誰もフォローしていません') }}</p>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Mixin from '../mixins/mixin';

export default {
  mixins: [Mixin],
  computed: {
    ...mapGetters(['getUser', 'getFollowings']),
  },
  data() {
    return {
      isLoading: false,
      isNotResults: false,
    };
  },
  methods: {
    ...mapActions(['addFollowings']),

    /**
     * 無限スクロールの範囲 フォロー中を取得する
     * @param {object} $state 無限スクロールを操作するオブジェクト
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 読み込み中ならスキップ
      this.isLoading = true;

      const fetchedIdList = this.getFetchedIdList(this.getFollowings);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let followings = [];
      try {
        const res = await axios.get('/api/followings', { params });
        followings = res.data;
        if (followings.length) {
          this.addFollowings(followings);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // フォロー中がいなければメッセージを表示
        this.isNotResults = !this.getFollowings.length; // ロード終了
        this.isLoading = false;
      }
    },

    /**
     * プロフィール画面に遷移
     * @param int id プロフィールに飛ぶユーザーのID
     */
    locationProfile(id) {
      window.location.href = `/step/profile/${id}`;
    },
  },
};
</script>
