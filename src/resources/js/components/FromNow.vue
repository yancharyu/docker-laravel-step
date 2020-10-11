<template>
  <span :class="className">{{ posted_at }}</span>
</template>

<script>
// momentを読み込み
window.moment = require('moment');

export default {
  props: {
    // 変換する日付を受け取る
    date: {
      type: [String, Number, Date],
      required: true,
    },
    // レイアウト用の追加クラス
    className: {
      type: String,
      default: '',
    },
  },
  computed: {
    /**
     * 日付を何時間前の表示に変換
     * @return {string} 何日前か
     */
    posted_at() {
      return moment(this.date).fromNow();
    },
  },
};
</script>
