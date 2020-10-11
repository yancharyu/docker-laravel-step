<template>
  <a
    :href="`/step/${step.id}`"
    class="c-panel"
    :class="{
      'c-panel--isChallenge': isChallenges,
      'c-panel--isClear': isClears,
    }"
  >
    <template v-if="isChallenges">
      <span class="c-panel__status c-panel__status--isChallenge">{{ $t('チャレンジ中') }}</span>
    </template>
    <template v-else-if="isClears">
      <span class="c-panel__status c-panel__status--isClear">{{ $t('クリア済み') }}</span>
    </template>
    <div class="c-panel__head">
      <img :src="getProfilePic(step.user)" class="c-avatar__pic" />
      <span class="c-avatar__username">{{ step.user.name }}</span>
    </div>
    <!-- </.c-panel__head> -->
    <div class="c-panel__body">
      <div class="c-panel__title">{{ convertedString(step.title) }}</div>
      <span class="c-panel__category">{{ step.category.name }}</span>
      <vue-from-now :date="this.step.created_at" class-name="c-panel__fromNow"></vue-from-now>
    </div>
    <!-- </.c-panel__body> -->

    <!-- マイページの進捗を表示する用の分岐 -->
    <template v-if="step.achievements_count !== undefined">
      <div class="c-panel__foot">
        <progress class="c-panel__progress" :max="step.stages_count" :value="step.achievements_count"></progress>
        <div class="c-panel__achievements">{{ step.achievements_count }} / {{ step.stages_count }} 達成済み</div>
      </div>
      <!-- </.c-panel__foot> -->
    </template>

    <!-- 基本は説明文を表示 -->
    <template v-else>
      <div class="c-panel__foot">{{ convertedString(step.description) }}</div>
    </template>
  </a>
  <!-- </.c-panel> -->
</template>

<script>
import FromNow from './FromNow.vue';
import Mixin from '../mixins/mixin';

export default {
  mixins: [Mixin],
  components: {
    'vue-from-now': FromNow,
  },
  props: {
    step: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isChallenges: this.step.challenges && this.step.challenges[0],
      isClears: this.step.clears && this.step.clears[0],
    };
  },
};
</script>
