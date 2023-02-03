import {reactive} from "vue";

export const store = reactive(
  {
    flash: {
      type   : 'success',
      message: ''
    },
  })