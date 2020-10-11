<template>
  <div class="c-form__item">
    <!-- propsでinputIdが渡されていなければinputNameを割り当てる -->
    <label :for="inputId ? inputId : inputName">
      {{ labelTitle }}（{{ maxLength }}{{ $t('文字以内') }}）
      <textarea
        :name="inputName"
        :id="inputId ? inputId : inputName"
        :cols="cols"
        :rows="rows"
        :class="{ 'c-textarea': true, 'u-err': errorMessage.length }"
        :placeholder="placeholder"
        v-model="value"
      >
      </textarea>
    </label>
    <!-- 文字数カウンター -->
    <div class="c-textarea__count">
      <!-- 最大文字数を超えたら文字色を赤にする -->
      <span class="c-textarea__countNum" :class="{ 'c-textarea__countNum--over': value.length > maxLength }">{{
        value.length
      }}</span>
      /
      {{ maxLength }}
    </div>

    <!-- エラーメッセージが渡されてきたら表示する -->
    <template v-if="errorMessage.length">
      <span class="u-require">{{ errorMessage }}</span>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    // ラベルのタイトル名
    labelTitle: {
      type: String,
      required: true,
    },
    // textareaのname属性
    inputName: {
      type: String,
      required: true,
    },
    // textareaのmax文字数（デフォルトは1000文字以内）
    maxLength: {
      type: Number,
      default: 1000,
    },
    // textareaのID(指定しなければinputName)
    inputId: {
      type: String,
      default: null,
    },
    // 横幅（デフォルトは40）
    cols: {
      type: Number,
      default: 40,
    },
    // 縦幅（デフォルトは10）
    rows: {
      type: Number,
      default: 10,
    },
    // プレースホルダー
    placeholder: {
      type: String,
      default: '',
    },
    // データベースの値（編集用、oldなど）
    oldValue: {
      type: String,
      default: '',
    },
    errorMessage: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      // textareaの値
      value: '',
    };
  },
  created() {
    // データベースの値(oldValue)がpropsで渡されていれば、valueにセットする
    if (this.oldValue.length) {
      this.value = this.oldValue;
    }
  },
};
</script>
