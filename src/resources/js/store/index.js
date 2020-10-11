import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import steps from './modules/steps';

Vue.use(Vuex);

export default new Vuex.Store({
  // 本番環境ではstrictモードはfalseにする
  strict: true,
  modules: {
    user,
    steps,
  },
});
