<template>
  <div class="c-confirm">
    <div class="c-confirm__mask" @click="$emit('false')">
      <div class="c-confirm__wrapper">
        <div class="c-confirm__confirm">
          <!-- ここの文言をslotに渡して変更する -->
          <slot name="confirm"> 本当に〜しますか？ </slot>
        </div>
        <div class="c-confirm__choice">
          <button class="c-confirm__btn c-confirm__btn--false" @click="$emit('false')">
            <!-- ここの文言をslotに渡して変更する -->
            <slot name="false">いいえ</slot>
          </button>
          <button class="c-confirm__btn c-confirm__btn--true" @click="$emit('true')">
            <!-- ここの文言をslotに渡して変更する -->
            <slot name="true">はい</slot>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
