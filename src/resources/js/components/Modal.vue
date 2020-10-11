<template>
  <div id="modal" class="c-modal js-modal c-modal--isActive">
    <div class="c-modal__overlay">
      <slot name="content">
        <div class="c-modal__inner">
          <h1 class="c-modal__title">
            <slot name="title">〜しました！</slot>
          </h1>
          <div class="c-btnContainer">
            <button @click="closeModal" class="c-btn c-modal__button">
              <slot name="button">ボタン</slot>
            </button>
          </div>
        </div>
      </slot>
    </div>
    <!-- </.c-modal__overlay> -->
  </div>
  <!-- </.c-modal> -->
</template>

<script>
export default {
  methods: {
    closeModal() {
      $('.js-modal').removeClass('c-modal--isActive');
    },
  },
};
</script>
