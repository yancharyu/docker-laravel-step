<template>
  <div class="p-top__search">
    <!-- submitされたことを親コンポーネントに通知 -->
    <form action="" @submit.prevent="$emit('keyword', keyword)">
      <div class="p-keyword">
        <input
          type="text"
          name="keyword"
          :placeholder="$t('キーワード検索')"
          class="p-keyword__input"
          autocomplete="off"
          v-model="keyword"
        />
        <button type="submit" class="p-keyword__button"><i class="fas fa-search p-keyword__search"></i></button>
      </div>
      <!-- </.p-keyword> -->
    </form>
    <div class="p-categorySearch p-categorySearch--hide js-categorySearch">
      <!-- カテゴリー一覧を表示 -->
      <template v-for="category of categories">
        <button
          class="p-categorySearch__button c-category"
          :class="{ 'p-categorySearch__button--isActive': category.id === categoryId }"
          @click.prevent="$emit('category', null, category.id)"
          :key="category.id"
        >
          {{ category.name }}
        </button>
      </template>
      <!-- </v-for> -->
    </div>
    <!-- </.p-categorySearch> -->
    <!-- isCategoryAllShowは描画時は空文字を入れて何も表示させない -->
    <!-- カテゴリーを取得したときに初めて表示させるようにする -->
    <template v-if="isCategoryAllShow === false">
      <span class="p-categorySearch__showHideButton" @click="showAllCategories">すべて表示</span>
    </template>
    <template v-else-if="isCategoryAllShow === true">
      <span class="p-categorySearch__showHideButton" @click="hideCategories">表示を減らす</span>
    </template>
  </div>
  <!-- </.p-top__search> -->
</template>

<script>
export default {
  props: {
    categoryId: {
      type: [Number],
      required: true,
    },
  },
  data() {
    return {
      keyword: null,
      categories: [],
      isCategoryAllShow: '',
    };
  },
  created() {
    // 描画されたときにApiでカテゴリー一覧を取得
    this.getCategories();
  },
  methods: {
    /**
     * Apiでカテゴリー一覧を取得する
     */
    async getCategories() {
      const res = await axios.get('/api/categories');
      this.categories = res.data;
      // カテゴリー一覧を取得した後に「さらに表示」ボタンを表示したいので、ここでfalseにセットする
      this.isCategoryAllShow = false;
    },
    /**
     * 隠れているカテゴリー一覧を表示する
     */
    showAllCategories() {
      this.isCategoryAllShow = true;
      $('.js-categorySearch').removeClass('p-categorySearch--hide');
    },
    /**
     * 追加で表示したカテゴリーを隠す
     */
    hideCategories() {
      this.isCategoryAllShow = false;
      $('.js-categorySearch').addClass('p-categorySearch--hide');
    },
  },
};
</script>
