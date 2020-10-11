<template>
  <div>
    <vue-search-step :category-id="category ? category : 0" @keyword="getSteps" @category="getSteps"></vue-search-step>
    <vue-step-list :step-list="stepList"></vue-step-list>

    <!-- 無限ロードの範囲 -->
    <infinite-loading ref="infiniteLoader" spinner="circles" @infinite="getStepsMore">
      <div slot="no-more"></div>
      <div slot="no-results"></div>
    </infinite-loading>
    <p v-show="isNotResults" class="u-noResults">{{ $t('投稿がありません') }}</p>
  </div>
</template>

<script>
import SearchStep from './SearchStep.vue';
import StepList from './StepList.vue';

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
      const fetchedStepIdList = [];
      const params = { keyword, category, fetchedStepIdList };
      // Apiで取得した結果リストを代入
      try {
        const res = await axios.get('/api/step', { params });
        this.stepList = res.data;
        this.$refs.infiniteLoader.stateChanger.reset();
        if (this.stepList.length) {
          // 無限ロードの状態をリセット
          this.$refs.infiniteLoader.stateChanger.loaded();
        } else {
          this.$refs.infiniteLoader.stateChanger.complete();
          this.isNotResults = true;
        }
      } catch (error) {
      } finally {
        this.$refs.infiniteLoader.stateChanger.complete();
      }
    },

    /**
     * Apiでstepを追加で取得
     * 検索条件があればそれに沿ってデータを取得
     *
     * @param {object} $state 無限ロードの状態を操作するためのメソッドがある
     */
    async getStepsMore($state) {
      if (this.isLoading) return; // 既に読み込み中ならスキップ
      // 状態をロード中に変更
      this.isLoading = true;

      // ID既に取得済みのID配列を取得
      const fetchedStepIdList = this.getFetchedStepIdList();
      const params = { keyword: this.keyword, category: this.category, fetchedStepIdList };
      // Apiで取得した結果をリストに追加
      try {
        const res = await axios.get('/api/step', { params });
        if (res.data.length) {
          res.data.forEach(step => {
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
        // ロード終了
        $state.complete();
        this.isLoading = false;
      }
    },

    /**
     * 現在既に取得しているstepListからID値だけ抜き出して配列に格納
     *
     * @return {number} 現在取得しているSTEPのIDの配列
     */

    getFetchedStepIdList() {
      // 最初の読み込みなどstepListがまだ空の場合は空の配列を返す
      if (!this.stepList.length) {
        return [];
      }

      const fetchedStepIdList = [];
      this.stepList.forEach(step => {
        fetchedStepIdList.push(step.id);
      });
      return fetchedStepIdList;
    },

    /**
     * 押された時にサイトのトップへ遷移する
     *
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
  },
};
</script>
