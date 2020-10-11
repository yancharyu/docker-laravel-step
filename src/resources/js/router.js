import Vue from 'vue';
import Router from 'vue-router';
import EditProfile from './components/EditProfile.vue';
import ChallengeSteps from './components/ChallengeSteps.vue';
import LikeSteps from './components/LikeSteps.vue';
import ClearSteps from './components/ClearSteps.vue';
import MypageTop from './components/MypageTop.vue';
import Following from './components/Following.vue';
import Follower from './components/Follower.vue';

Vue.use(Router);

const routes = [
  {
    path: '/mypage/follow',
    name: 'follow',
    component: Following,
  },
  {
    path: '/mypage/follower',
    name: 'follower',
    component: Follower,
  },
  {
    path: '/mypage/profile',
    name: 'edit_profile',
    component: EditProfile,
  },
  {
    path: '/mypage/challenges',
    name: 'challenges',
    component: ChallengeSteps,
  },
  {
    path: '/mypage/likes',
    name: 'likes',
    component: LikeSteps,
  },
  {
    path: '/mypage/clears',
    name: 'clears',
    component: ClearSteps,
  },
  {
    path: '/mypage',
    name: 'mypage',
    component: MypageTop,
  },
  {
    path: '/mypage/*',
    redirect: { name: 'mypage' },
  },
];

export default new Router({
  mode: 'history',
  routes,
});
