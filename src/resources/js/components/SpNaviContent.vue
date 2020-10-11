<template>
  <div class="p-spNaviMenu" :class="{ 'p-spNaviMenu--isActive': isActive }">
    <div class="p-spNaviMenu__container">
      <!--  ログイン中なら -->
      <template v-if="isLogin">
        <div class="p-spNaviMenu__item">
          <a href="/step" class="p-spNaviMenu__link">
            <i class="far fa-clock"></i>
            {{ $t('タイムライン') }}
          </a>
        </div>
        <!-- </.p-spNaviMenu__item> -->
        <div class="p-spNaviMenu__item">
          <a href="/mypage" class="p-spNaviMenu__link">
            <i class="fas fa-user"></i>
            {{ $t('マイページ') }}
          </a>
        </div>
        <!-- </.p-spNaviMenu__item> -->
        <div class="p-spNaviMenu__item">
          <a href="/step/create" class="p-spNaviMenu__link">
            <i class="fas fa-pencil-alt"></i>
            {{ $t('新規投稿') }}
          </a>
        </div>
        <!-- </.p-spNaviMenu__item> -->
      </template>
      <!-- ログインしていない場合 -->
      <template v-else>
        <div class="p-spNaviMenu__item">
          <a href="/login" class="p-spNaviMenu__link">{{ $t('ログイン') }}</a>
        </div>
        <!-- </.p-spNaviMenu__item> -->
        <div class="p-spNaviMenu__item">
          <a href="/register" class="p-spNaviMenu__link">{{ $t('新規登録') }}</a>
        </div>
        <!-- </.p-spNaviMenu__item> -->
      </template>
    </div>
    <!-- </.p-spNaviMenu__container> -->
  </div>
  <!-- </.p-spNaviMenu> -->
</template>

<script>
export default {
  props: {
    isLogin: {
      type: Boolean,
      required: true,
    },
    isActive: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    /**
     * 親コンポーネントに通知する
     */
    closeSpNavi() {
      this.$emit('close');
    },
  },
};
</script>
