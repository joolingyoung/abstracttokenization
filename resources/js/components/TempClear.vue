<template></template>
<script>
import Cookies from 'js-cookie';
export default {
 props: ['cook','field'],
 mounted () {
     if (this.cook.indexOf(',') > -1) {
         let clear = this.cook.split(',')
         if (clear.length > 0) {
             for (let key in clear) {
                 Cookies.remove(this.field + clear[key]);
             }
         }
     } else {
        Cookies.remove(this.field + this.cook);
     }
 }   
}
</script>
