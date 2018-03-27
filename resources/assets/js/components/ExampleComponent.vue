<template>
  <div>
    <div class="block">
      <date-picker :time-picker="true" v-model="date" format="YYYY-MM-DD H:mm" :show-ranges="true" position="left">
        <input type="text">
      </date-picker>
      <span class="block">{{date}}</span>
    </div>
  </div>
</template>

<script>
import DatePicker from './DatePicker';
export default {
  components: {
    DatePicker
  },
  data() {
    return {
      date: null,
    };
  }
};
</script>
