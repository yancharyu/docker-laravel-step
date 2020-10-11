import {
  SET_MY_STEPS,
  SET_CHALLENGE_STEPS,
  SET_LIKE_STEPS,
  SET_CLEAR_STEPS,
  ADD_MY_STEPS,
  ADD_CHALLENGE_STEPS,
  ADD_LIKE_STEPS,
  ADD_CLEAR_STEPS,
} from '../action-types';

const state = {
  mySteps: [],
  challengeSteps: [],
  likeSteps: [],
  clearSteps: [],
};

const getters = {
  getMySteps: state => state.mySteps,
  getChallengeSteps: state => state.challengeSteps,
  getLikeSteps: state => state.likeSteps,
  getClearSteps: state => state.clearSteps,
};

const mutations = {
  setMySteps(state, payload) {
    state.mySteps = payload;
  },
  setChallengeSteps(state, payload) {
    state.challengeSteps = payload;
  },
  setLikeSteps(state, payload) {
    state.likeSteps = payload;
  },
  setClearSteps(state, payload) {
    state.clearSteps = payload;
  },
  addMySteps(state, payload) {
    if (payload.length) {
      payload.forEach(step => {
        state.mySteps.push(step);
      });
    }
  },
  addChallengeSteps(state, payload) {
    if (payload.length) {
      payload.forEach(step => {
        state.challengeSteps.push(step);
      });
    }
  },
  addLikeSteps(state, payload) {
    if (payload.length) {
      payload.forEach(step => {
        state.likeSteps.push(step);
      });
    }
  },
  addClearSteps(state, payload) {
    if (payload.length) {
      payload.forEach(step => {
        state.clearSteps.push(step);
      });
    }
  },
};

const actions = {
  [SET_MY_STEPS]({ commit }, payload) {
    commit('setMySteps', payload);
  },
  [SET_CHALLENGE_STEPS]({ commit }, payload) {
    commit('setChallengeSteps', payload);
  },
  [SET_LIKE_STEPS]({ commit }, payload) {
    commit('setLikeSteps', payload);
  },
  [SET_CLEAR_STEPS]({ commit }, payload) {
    commit('setClearSteps', payload);
  },
  [ADD_MY_STEPS]({ commit }, payload) {
    commit('addMySteps', payload);
  },
  [ADD_CHALLENGE_STEPS]({ commit }, payload) {
    commit('addChallengeSteps', payload);
  },
  [ADD_LIKE_STEPS]({ commit }, payload) {
    commit('addLikeSteps', payload);
  },
  [ADD_CLEAR_STEPS]({ commit }, payload) {
    commit('addClearSteps', payload);
  },
};

export default {
  state,
  getters,
  mutations,
  actions,
};
