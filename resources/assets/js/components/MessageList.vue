<template>
  <div>
    <ul>
        <Message
          @changed="handleMessageClick"
          :message="message"
          v-for="message in messages"
          :key="message"></Message>
    </ul>
      <span @benny="callB">Hello</span>
    
  </div>
</template>

<script>
import Message from './Message'

export default {
  name: 'MessageList',
  props: ['messages'],
  methods: {
    handleMessageClick() {
      // console.log(message)
    },
    callB() {
       this.$emit('changed');
    }
  },
  components: {
    Message
  }
}
</script>
