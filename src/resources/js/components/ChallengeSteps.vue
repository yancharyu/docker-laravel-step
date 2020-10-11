<template>
  <div class="p-mypage__main">
    <h1 class="p-mypage__title">{{ $t('チャレンジ中') }}</h1>
    <vue-step-list :step-list="getChallengeSteps"></vue-step-list>

    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('チャレンジ中はありません') }}</p>
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
    ...mapGetters(['getChallengeSteps']),
  },
  methods: {
    ...mapActions(['addChallengeSteps']),

    /**
     * 無限スクロールの範囲 チャレンジ中のステップを取得
     * @param {object} $state 無限スクロールを操作するオブジェクト
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 読み込み中ならスキップ
      this.isLoading = true;

      const fetchedIdList = this.getFetchedIdList(this.getChallengeSteps);
      const params = { fetchedIdList };
      // APIの結果の配列を格納する変数
      let steps = [];
      try {
        const res = await axios.get('/api/challenges', { params });
        steps = res.data;
        if (steps.length) {
          this.addChallengeSteps(steps);
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
        }
      } finally {
        // チャレンジ中がなければメッセージを表示
        this.isNotResults = !this.getChallengeSteps.length;
        // ロード終了
        this.isLoading = false;
      }
    },
  },
};
</script>
