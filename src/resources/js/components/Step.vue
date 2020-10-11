<template>
  <div>
    <vue-search-step :category-id="category ? category : 0" @keyword="getSteps" @category="getSteps"></vue-search-step>
    <vue-step-list :step-list="stepList"></vue-step-list>

    <!-- 無限ロードの範囲 -->
    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="infiniteHandler">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('投稿がまだありません') }}</p>
  </div>
</template>

<script>
import SearchStep from './SearchStep.vue';
import StepList from './StepList.vue';
import Mixin from '../mixins/mixin';

export default {
  components: {
    'vue-step-list': StepList,
    'vue-search-step': SearchStep,
  },
  data() {
    return {
      stepList: [],
      keyword: '', // 検索条件を記憶しておく
      category: null, // 検索条件を記憶しておく
      isLoading: false, // ロード中かどうかのフラグ
      isNotResults: false,
    };
  },
  mixins: [Mixin],
  methods: {
    /**
     * Apiでstep一覧を取得
     *
     * @param {string} keyword=null 検索キーワード
     * @param {number} category=null カテゴリ-
     */
    async getSteps(keyword = null, category = null) {
      this.keyword = keyword;
      this.category = category;
      // このID配列に入ってないデータを取得する（検索なので0）
      const fetchedIdList = [];
      const params = { keyword, category, fetchedIdList };
      // Apiで取得した結果リストを代入
      try {
        const res = await axios.get('/api/step', { params });
        this.stepList = res.data;
        // 無限ロードの状態をリセット
        this.$refs.infiniteLoader.stateChanger.reset();
        if (this.stepList.length) {
          this.$refs.infiniteLoader.stateChanger.loaded();
        } else {
          this.$refs.infiniteLoader.stateChanger.complete();
          this.isNotResults = true;
        }
      } catch (error) {}
    },

    /**
     * Apiでstepを追加で取得
     * 検索条件があればそれに沿ってデータを取得
     *
     * @param {object} $state 無限ロードの状態を操作するためのメソッドがある
     */
    async infiniteHandler($state) {
      if (this.isLoading) return; // 既に読み込み中ならスキップ
      // 状態をロード中に変更
      this.isLoading = true;

      // ID既に取得済みのID配列を取得
      const fetchedIdList = this.getFetchedIdList(this.stepList);
      const params = { keyword: this.keyword, category: this.category, fetchedIdList };
      // APIの結果の配列を格納する変数
      let steps = [];
      // Apiで取得した結果をリストに追加
      try {
        const res = await axios.get('/api/step', { params });
        steps = res.data;
        if (steps.length) {
          steps.forEach(step => {
            this.stepList.push(step);
          });
          // 読み込みが終わって、まだ読み込めればloaded()を呼ぶ
          $state.loaded();
        } else {
          // もう読み込めなければcomplete()を呼ぶ
          $state.complete();
          this.isNotResults = true;
        }
      } finally {
        // 投稿がなければメッセージを表示
        this.isNotResults = !this.stepList.length;
        // ロード終了
        this.isLoading = false;
      }
    },
  },
};
</script>
