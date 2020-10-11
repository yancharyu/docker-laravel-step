<template>
  <div class="c-form__item">
    <label :for="id" class="p-passwordInput">
      {{ $t(labelTitle) }}
      <div class="p-passwordInput__container">
        <input
          :type="isMasked ? 'password' : 'text'"
          :name="inputName"
          :id="id"
          :class="{ 'c-input': true, 'c-input--error': isError }"
          spellcheck="false"
          :placeholder="placeholder"
        />
        <i
          :class="{
            'p-passwordInput__icon': true,
            fas: true,
            'fa-eye': this.isMasked,
            'fa-eye-slash': !this.isMasked,
          }"
          @click="toggleMask"
        ></i>
      </div>
    </label>

    <span class="u-require" role="alert" v-if="isError">
      <strong>{{ errorMessage }}</strong>
    </span>
  </div>
</template>

<script>
export default {
  props: {
    inputId: {
      type: String,
      default: null,
    },
    labelTitle: {
      type: String,
      default: null,
    },
    inputName: {
      type: String,
      required: true,
    },
    errorMessage: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      id: this.inputId ? this.inputId : this.inputName,
      isError: !!this.errorMessage,
      isMasked: true,
      iconClass: {},
    };
  },
  methods: {
    /**
     * パスワードの表示非表示を切り替える
     */
    toggleMask() {
      this.isMasked = !this.isMasked;
    },
  },
};
</script>
