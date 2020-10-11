<template>
  <div class="c-panel__wrapper">
    <template v-if="stepList.length">
      <template v-for="step of stepList">
        <vue-step-card :step="step" :key="step.id"></vue-step-card>
      </template>
      <!-- </v-for> -->
    </template>
  </div>
  <!-- </.c-panel__wrapper> -->
</template>

<script>
import StepCard from './StepCard.vue';

export default {
  props: {
    stepList: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      noResultsMessage: '',
    };
  },
  components: {
    'vue-step-card': StepCard,
  },
};
</script>
