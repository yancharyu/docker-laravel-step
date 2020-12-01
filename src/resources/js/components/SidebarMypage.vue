<template>
  <div class="p-mypageSidebar js-sidebar">
    <h1 class="p-mypageSidebar__title">{{ $t('マイページ') }}</h1>
    <span class="p-mypageSidebar__closeIcon" @click="closeSidebar">
      <i class="fas fa-times"></i>
    </span>

    <vue-user-profile-pic :user="getUser"></vue-user-profile-pic>
    <p class="p-mypageSidebar__username">{{ getUser.name }}</p>
    <div class="p-mypageSidebar__relationsContainer">
      <li class="p-mypageSidebar__listItem" @click="closeSidebar">
        <router-link :to="{ name: 'follow' }" class="p-mypageSidebar__follow"
          >{{ followings }}{{ $t('フォロー') }}</router-link
        >
      </li>
      <li class="p-mypageSidebar__listItem" @click="closeSidebar">
        <router-link :to="{ name: 'follower' }" class="p-mypageSidebar__follower"
          >{{ followers }}{{ $t('フォロワー') }}</router-link
        >
      </li>
    </div>
    <div class="p-mypageSidebar__contentContainer">
      <ul class="p-mypageSidebar__list">
        <li class="p-mypageSidebar__listItem" @click="closeSidebar">
          <router-link :to="{ name: 'mypage' }" active-class="p-mypageSidebar__listItem--isActive" exact>{{
            $t('投稿一覧')
          }}</router-link>
        </li>
        <li class="p-mypageSidebar__listItem" @click="closeSidebar">
          <router-link :to="{ name: 'edit_profile' }" active-class="p-mypageSidebar__listItem--isActive" exact>{{
            $t('プロフィール編集')
          }}</router-link>
        </li>
        <li class="p-mypageSidebar__listItem" @click="closeSidebar">
          <router-link :to="{ name: 'challenges' }" active-class="p-mypageSidebar__listItem--isActive" exact>{{
            $t('チャレンジ中')
          }}</router-link>
        </li>
        <li class="p-mypageSidebar__listItem" @click="closeSidebar">
          <router-link :to="{ name: 'likes' }" active-class="p-mypageSidebar__listItem--isActive" exact>{{
            $t('お気に入り')
          }}</router-link>
        </li>
        <li class="p-mypageSidebar__listItem" @click="closeSidebar">
          <router-link :to="{ name: 'clears' }" active-class="p-mypageSidebar__listItem--isActive" exact>{{
            $t('クリア済み')
          }}</router-link>
        </li>
        <li class="p-mypageSidebar__listItem">
          <a href="/edit-password">{{ $t('パスワード変更') }}</a>
        </li>
        <!-- 押したときにフォーム送信  -->
        <li class="p-mypageSidebar__listItem">
          <a href="#" @click="logout">{{ $t('ログアウト') }}</a>
        </li>
        <li class="p-mypageSidebar__listItem">
          <a href="/withdraw">{{ $t('退会する') }}</a>
        </li>
      </ul>

      <!-- ログアウト用のフォーム -->
      <!-- 基本は非表示にして置いてサイドバーのログアウトボタンが押されたときにフォーム送信する -->
      <form id="form_logout" action="/logout" class="u-dispNone" method="POST">
        <input type="hidden" name="_token" :value="token" />
      </form>
    </div>
    <!-- </.p-mypageSidebar__contentContainer> -->
  </div>
  <!-- </.p-mypageSidebar -->
</template>

<script>
import { mapGetters } from 'vuex';
import UserProfilePic from './UserProfilePic.vue';

export default {
  components: {
    'vue-user-profile-pic': UserProfilePic,
  },
  data() {
    return {
      token: '',
      followings: '',
      followers: '',
    };
  },
  computed: {
    ...mapGetters(['getUser']),
  },
  methods: {
    /**
     * サイドバーを閉じる
     */
    closeSidebar() {
      $('.js-sidebar').removeClass('p-mypageSidebar--isActive');
      $('.js-mypageOverlay').removeClass('p-mypage__overlay--isActive');
    },

    /**
     * ログアウト処理
     * @param {object} event イベントオブジェクト
     */
    logout(event) {
      event.preventDefault();
      document.getElementById('form_logout').submit();
    },
  },
  created() {
    this.token = $('meta[name="csrf-token"]').attr('content');
    this.followings = this.getUser.followings.length;
    this.followers = this.getUser.followers.length;
  },
};
</script>
