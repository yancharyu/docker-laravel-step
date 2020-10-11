<template>
  <div class="p-mypage__main p-mypage__main--relations">
    <h1 class="p-mypage__title">{{ $t('フォロワー') }}</h1>
    <a v-for="user in getFollowers" :key="user.id" class="c-avatar p-mypage__avatar" @click="locationProfile(user.id)">
      <img :src="getProfilePic(user)" class="c-avatar__pic" />
      <span class="c-avatar__name">{{ user.name }}</span>
    </a>

    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('フォロワーはいません') }}</p>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Mixin from '../mixins/mixin';

export default {
  mixins: [Mixin],
  computed: {
    ...mapGetters(['getUser', 'getFollowers']),
  },
  data() {
    return {
      isLoading: false,
      isNotResults: false,
    };
  },
  methods: {
    ...mapActions(['addFollowers']),

    /**
     * 無限スクロールの範囲 フォロワーを取得
     * @param {object} $state 無限スクロールを操作するオブジェクト
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 読み込み中ならスキップ
      this.isLoading = true;

      const fetchedIdList = this.getFetchedIdList(this.getFollowers);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let followers = [];
      try {
        const res = await axios.get('/api/followers', { params });
        followers = res.data;
        if (followers.length) {
          this.addFollowers(followers);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // フォロワーがいなければメッセージを表示
        this.isNotResults = !this.getFollowers.length;
        // ロード終了
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
