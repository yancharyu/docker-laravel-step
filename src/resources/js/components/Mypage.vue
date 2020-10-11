<template>
  <div class="p-mypage">
    <!-- サイトバー -->
    <vue-sidebar-mypage></vue-sidebar-mypage>

    <div class="p-mypage__picContainer">
      <i class="fas fa-cog p-mypage__optionIcon" @click="showSidebar"></i>
      <img :src="getUserProfilePic" alt="" class="p-mypage__pic" />
      <p class="p-mypage__name">{{ getUser.name }}</p>
    </div>
    <!-- </.p-mypage__picContainer> -->

    <router-view />
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import SidebarMypage from './SidebarMypage.vue';

export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  components: {
    'vue-sidebar-mypage': SidebarMypage,
  },
  computed: {
    ...mapGetters(['getUser', 'getUserProfilePic', 'getMySteps']),
  },
  methods: {
    ...mapActions(['setUser', 'setMySteps']),
    /**
     * マイページを表示する
     */
    showSidebar() {
      $('.js-sidebar').addClass('p-mypageSidebar--isActive');
      $('.js-mypageOverlay').addClass('p-mypage__overlay--isActive');
    },
  },
  created() {
    this.setUser(this.user);
  },
};
</script>
