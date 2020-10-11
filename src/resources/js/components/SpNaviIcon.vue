<template>
  <div class="p-spNaviIcon" @click="$emit('toggle')">
    <span class="p-spNaviIcon__line" :class="{ 'p-spNaviIcon__line--isActive': isActive }"></span>
    <span class="p-spNaviIcon__line" :class="{ 'p-spNaviIcon__line--isActive': isActive }"></span>
    <span class="p-spNaviIcon__line" :class="{ 'p-spNaviIcon__line--isActive': isActive }"></span>
  </div>
  <!-- </.p-spNaviIcon> -->
</template>

<script>
export default {
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
