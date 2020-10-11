<template>
  <div class="p-mypage__main">
    <h1 class="p-mypage__title">{{ $t('お気に入り') }}</h1>
    <vue-step-list :step-list="getLikeSteps"></vue-step-list>

    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('お気に入りはありません') }}</p>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import StepList from './StepList.vue';
import Mixin from '../mixins/mixin';

export default {
  mixins: [Mixin],
  components: {
    'vue-step-list': StepList,
  },
  data() {
    return {
      isLoading: false,
      isNotResults: false,
    };
  },
  computed: {
    ...mapGetters(['getLikeSteps']),
  },
  methods: {
    ...mapActions(['addLikeSteps']),

    /**
     * 無限スクロールの範囲 お気に入りのステップを取得する
     * @param {object} $state 無限スクロールを操作するオブジェクト
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 読み込み中ならスキップ
      this.isLoading = true;

      const fetchedIdList = this.getFetchedIdList(this.getLikeSteps);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let steps = [];
      try {
        const res = await axios.get('/api/like-steps', { params });
        steps = res.data;
        if (steps.length) {
          this.addLikeSteps(steps);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // お気に入りがなければメッセージを表示
        this.isNotResults = !this.getLikeSteps.length;
        // ロード終了
        this.isLoading = false;
      }
    },
  },
};
</script>
