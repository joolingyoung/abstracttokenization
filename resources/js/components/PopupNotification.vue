<template>
    <div>
        <Modal
        v-model="modal"
        v-bind:class="['notifcation-modal', (loader === 'true') ? loader : '', (browsertype === 'Chrome') ? 'Chrome-modal' : 'Safari-modal']"
        >
            <div v-if="browsertype == 'Chrome'" class="arrow-up"></div>
            <div slot="header">
                <img class="noti-logo" src="/img/logo-abstract.png"></img>
            </div>
            <div>
            </div>
            <div class="popup-content">
                <span v-if="browsertype == 'Safari'" v-html="info"></span>
                <span v-if="browsertype == 'Chrome'" v-html="info1"></span>
                <Icon class="spin-yellow" v-if="loader === 'true'" type="ios-loading" />
                <br/>
            </div>
            <div v-if="browsertype == 'Safari'" class="arrow-down"></div>
        </Modal>
    </div>
</template>
<script>
import Cookies from 'js-cookie';
export default {
    props: ['title', 'info', 'info1', 'type', 'user', 'browsertype', 'loader'],
    data () {
        return {
            modal: true
        }
    },
    created () {
        let popup = Cookies.get('notification')
        let val = 'notification' + this.user
        if ( popup != null && popup === val ) 
            this.modal = false;
        else {
            Cookies.set('notification', val, { expires: 364 })
            this.modal = true;
        }
        this.loader === 'true' ? this.autoRedirect() : 'adsf'
    },
    methods: {
        call () {
            this.modal = false
            if (this.url && this.url != 'null') {
                if (this.download == 'true') {
                    this.download_file(this.url, 'Some Name')
                } else {
                    window.location.href = this.url
                }
                
            }
        },

        autoRedirect() {
            var self = this
            setTimeout(function(){
                window.location.href = self.url 
            }
            , 3000);
        }
    }
}
</script>
<style>
    .notifcation-modal .ivu-modal{
        position: absolute; 
    }
    .Safari-modal .ivu-modal{
        top: initial !important;
        bottom: 30px;
    }
    .Chrome-modal .ivu-modal{
        top: 30px;
        right: -50px;
    }
    .notifcation-modal .ivu-modal-content{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .noti-close{
        position: absolute;
        left: 5px;
        font-size: 3em;
    }
    .spin-yellow{
        color: #CCCC00;
        font-size: 24px;
        animation: ani-demo-spin 1s linear infinite;
    }
    .white-title-back{
        color:black;
        background-color: white;
    }
    .notifcation-modal .card-title{
        text-align: center;
    }
    .notifcation-modal .card-title h5 .intern-close{
        font-size: 2em;
        position: absolute;
        right: 5px;
        font-weight: inherit;
    }
    .notifcation-modal .ivu-modal-close{
        display: none;
    }
    .notifcation-modal .ivu-modal-footer{
        display:none;
    }
    .arrow-down {
        width: 0; 
        height: 0; 
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        border-top: 30px solid white;
        font-size: 0;
        line-height: 0;
        position: absolute;
        left: 40%;
        top: 100%;
    }
    .arrow-up {
        width: 0; 
        height: 0; 
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        border-bottom: 30px solid white;
        font-size: 0;
        line-height: 0;
        position: absolute;
        right: 5px;
        bottom: 100%;
    }
    .noti-logo{
        width: 100px;
        height: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }
    .popup-content{
        padding: 0;
        text-align: center;
    }
    .popup-content span h5 img {
        vertical-align: middle;
    }
    
</style>
