<template>
  <img :src="getUserProfilePic()" :class="classNames ? classNames : 'p-mypageSidebar__pic'" />
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
    classNames: {
      type: String,
      default: '',
    },
  },
  methods: {
    getUserProfilePic() {
      // ユーザーがプロフィール写真を登録していればその写真を、していないければデフォルトの画像を表示する
      return this.user.pic ? this.user.pic : '/images/NO_IMG.png';
    },
  },
};
</script>
