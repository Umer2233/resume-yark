<template>
  <div style="background-color:white;">
    <!-- <b>#{{item.id}}</b> -->
    <div style="font-size:16px; color:#2684fe; font-family:Hind; padding-top:8px;padding-bottom:0px; padding-right:20px; padding-left:20px"><strong>{{ item.name }}</strong></div>
    <div style="font-size:14px; font-family:Hind; padding-top:0px;padding-bottom:5px; padding-right:20px; padding-left:20px">{{item.content}}</div>  
    <hr style="margin-top:0px;margin-bottom:0px">
  </div>
</template>

<script>
export default {
  props: {
    item: { required: true },
  }
}
</script>