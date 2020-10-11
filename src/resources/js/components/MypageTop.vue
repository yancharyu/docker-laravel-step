<template>
  <div class="p-mypage__main">
    <h1 class="p-mypage__title">{{ $t('投稿一覧') }}</h1>
    <vue-step-list :step-list="getMySteps"></vue-step-list>

    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('投稿がまだありません') }}</p>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import StepList from './StepList.vue';
import Mixin from '../mixins/mixin';

export default {
  data() {
    return {
      isLoading: false,
      isNotResults: false,
    };
  },
  mixins: [Mixin],
  components: {
    'vue-step-list': StepList,
  },
  computed: {
    ...mapGetters(['getMySteps']),
  },
  methods: {
    ...mapActions(['addMySteps']),

    /**
     * 無限スクロールの範囲 自分の投稿一覧を取得する
     * @param {object} $state 無限スクロールを操作するオブジェクト
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 読み込み中gならスキップ
      this.isLoading = true;

      const fetchedIdList = this.getFetchedIdList(this.getMySteps);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let steps = [];
      try {
        const res = await axios.get('/api/my-steps', { params });
        steps = res.data;
        if (steps.length) {
          this.addMySteps(steps);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // 投稿がなければメッセージを表示
        this.isNotResults = !this.getMySteps.length;
        // ロード終了
        this.isLoading = false;
      }
    },
  },
};
</script>
