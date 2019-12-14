<template>
  <div class="noty-manager-list-item noty-manager-list-item-error">
    <div class="activity-item">
      <div class="activity">
        <img class="avatar" src="https://s3.amazonaws.com/codecademy-content/projects/2/feedster/wr2.svg" />
        <h6>{{ item.title }}</h6>
        <p>{{ item.body }}</p>
      </div> 
      <div class="actions-container">
        <a class="btn-read" @click.prevent="markAsRead"><i class="fa fa-close"></i></a>
      </div>
    </div>
  </div>
</template>
   
<script>  
  export default {
    props: ['item'],
    methods: {
      markAsRead (ev) {
        ev.stopPropagation();
        this.$emit('read')
      }
    }
  }
</script>
