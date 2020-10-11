<template>
  <div>
    <div class="c-btnContainer">
      <!-- フォローしていない場合はフォローボタンを表示させる -->
      <template v-if="isFollow">
        <button
          :class="{
            'p-profile__followButton': true,
            // 既にフォローしている場合はボタンのスタイルを変更する
            'p-profile__followButton--isFollow': isFollow,
          }"
          @click="showConfirm"
        >
          フォロー中
        </button>
      </template>
      <template v-else>
        <button class="p-profile__followButton" @click="toggleFollow">フォローする</button>
      </template>
    </div>
    <vue-confirm v-if="isShowConfirm" @false="closeConfirm" @true="toggleFollow">
      <template #confirm>フォローを解除しますか？</template>
      <template #true>フォロー解除</template>
    </vue-confirm>
  </div>
</template>

<script>
import Confirm from './Confirm.vue';

export default {
  props: {
    userId: {
      type: Number,
      required: true,
    },
  },
  components: {
    'vue-confirm': Confirm,
  },
  data() {
    return {
      isFollow: null,
      isShowConfirm: false,
    };
  },
  methods: {
    /**
     * 既にフォローしているかどうかを取得する
     */
    async getIsFollow() {
      const params = { user_id: this.userId };
      try {
        const res = await axios.get('/api/follow', { params });
        this.isFollow = res.data.isFollow;
      } catch (e) {}
    },

    /**
     * フォロー状態を切り替える
     */
    async toggleFollow() {
      try {
        const res = await axios.post('/api/follow', { user_id: this.userId });
        this.isFollow = res.data.isFollow;

        // confirmが出ている場合は非表示にする
        if (this.isShowConfirm === true) {
          this.isShowConfirm = false;
        }
      } catch (e) {}
    },

    /**
     * フォロー解除の確認confirmを表示する
     */
    showConfirm() {
      this.isShowConfirm = true;
    },

    /**
     * confirmを閉じる
     */
    closeConfirm() {
      this.isShowConfirm = false;
    },
  },
  created() {
    this.getIsFollow();
  },
};
</script>
