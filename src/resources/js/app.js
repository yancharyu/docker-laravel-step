/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import Vuetify from 'vuetify';
// import 'vuetify/dist/vuetify.min.css';
import InfiniteLoading from 'vue-infinite-loading';
import VueI18n from 'vue-i18n';
import Mypage from './components/Mypage.vue';
import router from './router';
import store from './store/index';
import messages from '../lang/messages.json';
import SpNavi from './components/SpNavi.vue';
import PasswordInput from './components/PasswordInput.vue';
import Step from './components/Step.vue';
import FromNow from './components/FromNow.vue';
import Modal from './components/Modal.vue';
import LikeIcon from './components/LikeIcon.vue';
import StepList from './components/StepList.vue';
import TextArea from './components/TextArea.vue';
import FollowButton from './components/FollowButton.vue';

require('./bootstrap');
require('./footerFixed');

// =============================================
// 開発が終わったらtrueにする
Vue.config.productionTip = true;
// ============================================

Vue.use(VueI18n);

// // 多言語化ファイルの設定
export const i18n = new VueI18n({
  locale: 'ja',
  fallbackLocale: 'ja',
  silentTranslationWarn: true,
  messages,
});
window.i18n = i18n;

Vue.use(InfiniteLoading);

// Vue.use(Vuetify);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/**
 *
 * vueコンポーネント名はblade内のどこでvueコンポーネントが使われているか
 *     特定しやすくするためと、将来的にhtmlタグと名前が衝突しないよう
 *     vue-プレフィックスをつける
 */

const app = new Vue({
  i18n,
  router,
  store,
  components: {
    'vue-sp-navi': SpNavi,
    'vue-modal': Modal,
    'vue-password-input': PasswordInput,
    'vue-step': Step,
    'vue-mypage': Mypage,
    'vue-from-now': FromNow,
    'vue-like-icon': LikeIcon,
    'vue-step-list': StepList,
    'vue-text-area': TextArea,
    'vue-follow-button': FollowButton,
  },
  mounted() {
    // フラッシュメッセージがあれば出して消す
    const showMsg = $('.js-flashMessage');
    if (showMsg.text()) {
      showMsg.slideDown('slow');
      setTimeout(() => {
        $(showMsg).slideUp('slow');
      }, 3000);
    }
  },
});
app.$mount('#app');
