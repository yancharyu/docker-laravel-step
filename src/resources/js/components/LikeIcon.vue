<template>
  <div class="p-show__like" @click="toggleLike">
    <!-- レンダリングされた際にアニメーションを走らせないようにするクラスを付与しておく -->
    {{ $t('お気に入り') }}
    <i
      class="fas fa-thumbs-up c-likeIcon js-transitionAndAnimation u-noTransitionAndAnimation"
      :class="{
        'c-likeIcon--isLiked': isLiked,
      }"
    ></i>
    <!-- いいねの数 -->
    <span class="c-likeIcon__counts">{{ compLikesCount }}</span>
  </div>
  <!-- </.p-show__like> -->
</template>

<script>
// import { throttle } from 'lodash';

export default {
  props: {
    userId: {
      type: Number,
      required: true,
    },
    stepId: {
      type: Number,
      required: true,
    },
    // いいねの数を受け取る
    propLikesCount: {
      type: Number,
      required: true,
    },
    // いいねしているかどうか
    propIsLiked: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      likesCount: this.propLikesCount, // お気に入りの数
      isLiked: this.propIsLiked, // お気に入りに登録しているか
    };
  },
  computed: {
    /**
     * お気に入りの数が1以上の場合はそのまま表示。０の場合は表示しない
     * @return {number, null} お気に入りの数 or null
     */
    compLikesCount() {
      return this.likesCount ? this.likesCount : null;
    },
  },
  methods: {
    /**
     * お気に入り登録（既に登録している場合は削除）
     *
     */
    async toggleLike() {
      const res = await axios.post('/api/likes', { user_id: this.userId, step_id: this.stepId });
      this.likesCount = res.data.likesCount;
      this.isLiked = res.data.isLiked;
    },
  },

  // ページが描画されたときにアニメーションが走ってしまう挙動を抑えるクラスを外す
  updated() {
    $('.js-transitionAndAnimation').removeClass('u-noTransitionAndAnimation');
  },
};
</script>
