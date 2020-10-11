<template>
  <div class="p-spNavi">
    <vue-sp-navi-icon :is-active="isActive" @toggle="toggleSpNavi"></vue-sp-navi-icon>
    <vue-sp-navi-content :is-login="isLogin" :is-active="isActive" @close="closeSpNavi"></vue-sp-navi-content>
  </div>
  <!-- </.p-spNavi> -->
</template>

<script>
import SpNaviContent from './SpNaviContent.vue';
import SpNaviIcon from './SpNaviIcon.vue';

export default {
  props: {
    // ログインしているかどうか
    isLogin: {
      type: Boolean,
      required: true,
    },
  },
  components: {
    'vue-sp-navi-content': SpNaviContent,
    'vue-sp-navi-icon': SpNaviIcon,
  },
  data() {
    return {
      isActive: false,
    };
  },
  /**
   * 状態を切り替える
   */
  methods: {
    toggleSpNavi() {
      this.isActive = !this.isActive;
    },

    /**
     * ナビを閉じる
     */
    closeSpNavi() {
      this.isActive = false;
    },
  },
};
</script>
