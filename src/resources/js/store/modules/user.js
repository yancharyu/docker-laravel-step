import { SET_USER, ADD_FOLLOWINGS, ADD_FOLLOWERS } from '../action-types';

const state = {
  user: {},
  followings: [],
  followers: [],
};

const getters = {
  getUser: state => state.user,
  getUserProfilePic: state => (state.user.pic ? state.user.pic : '/images/NO_IMG.png'),
  getFollowings: state => state.followings,
  getFollowers: state => state.followers,
};

const mutations = {
  setUser(state, payload) {
    state.user = payload;
  },
  addFollowings(state, payload) {
    if (payload.length) {
      payload.forEach(following => {
        state.followings.push(following);
      });
    }
  },
  addFollowers(state, payload) {
    if (payload.length) {
      payload.forEach(follower => {
        state.followers.push(follower);
      });
    }
  },
};

const actions = {
  [SET_USER]({ commit }, payload) {
    commit('setUser', payload);
  },
  [ADD_FOLLOWINGS]({ commit }, payload) {
    commit('addFollowings', payload);
  },
  [ADD_FOLLOWERS]({ commit }, payload) {
    commit('addFollowers', payload);
  },
};

export default {
  state,
  getters,
  mutations,
  actions,
};
