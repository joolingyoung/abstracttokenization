<template>
    <div>
        <Modal
        v-model="modal"
        on-cancel="call"
        v-bind:class="{ 'auto-pop' : loader === 'true' }"
        class="popup-modal">
            <div class="card-title dust" slot="header">
                <h5>{{ title }}</h5>
            </div>
            <div class="popup-review-content">
                <span v-html="info"></span>
                <Icon class="spin-yellow" v-if="loader === 'true'" type="ios-loading" />
                <br/>
                <span v-if="loadermsg" v-html="loadermsg"></span>
                <a v-if="action" class="btn color-white" @click="call">{{ action }}</a>
            </div>
            <div slot="footer"></div>
        </Modal>
    </div>
</template>
<script>
import Cookies from 'js-cookie';
export default {
    props: ['title', 'info', 'type', 'user', 'url', 'action', 'download', 'loadermsg', 'loader'],
    data () {
        return {
            modal: true
        }
    },
    created () {

        if (this.type === 'basic' && this.user != null) {
            this.popInterval() === true ? this.modal = true : this.modal = false
        }

        this.loader === 'true' ? this.autoRedirect() : ''

    },
    methods: {
        popInterval () {
            let popup = Cookies.get('popup')
            let val = 'once' + this.user
            if ( popup != null && popup === val) {
                return false
            } else {
                Cookies.set('popup', val, { expires: 364 })
                return true
            }
        },
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
        download_file(fileURL, fileName) {
            // for non-IE
            if (!window.ActiveXObject) {
                var save = document.createElement('a');
                save.href = fileURL;
                save.target = '_blank';
                var filename = fileURL.substring(fileURL.lastIndexOf('/')+1);
                save.download = fileName || filename;
	               if ( navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/) && navigator.userAgent.search("Chrome") < 0) {
	        			document.location = save.href; 
                    // window event not working here
			        }else{
		                var evt = new MouseEvent('click', {
		                    'view': window,
		                    'bubbles': true,
		                    'cancelable': false
		                });
		                save.dispatchEvent(evt);
		                (window.URL || window.webkitURL).revokeObjectURL(save.href);
			        }	
            }
            // for IE < 11
            else if ( !! window.ActiveXObject && document.execCommand)     {
                var _window = window.open(fileURL, '_blank');
                _window.document.close();
                _window.document.execCommand('SaveAs', true, fileName || fileURL)
                _window.close();
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
    .popup-modal .ivu-modal-mask{
        background: #283F5C;
        /* background-color: rgba(0,0,0,0.4) */
    }
    .popup-modal .ivu-modal-footer{
        display: none;
    }
    .popup-modal .ivu-modal-content{
        overflow: hidden;
    }
    .auto-pop .ivu-modal-close{
        display:none !important;
    }
    .popup-modal .ivu-modal-close{
        position: fixed;
        top: 20px;
        right: 20px;
        margin: auto;
        cursor: pointer;
        text-align: left !important;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        padding: 7px;
    }
    .popup-modal .ivu-modal-close i{
        color: #fff !important;
        font-size: 3.5em;
        font-weight: bold;
    }
    .popup-modal .ivu-modal-header{
        padding: 0 !important;
        border: none !important;
    }
    .popup-modal .card-title {
        text-align: left;
        position: relative;
        width: 100%;
        border-radius:0;
    }
    .popup-modal .card-title h5 {
        float: none
    }
    .popup-modal .card-title h5 span {
        color: #7788B8;
        font-size: 15px;
        margin-right: 5px
    }

    .popup-modal .card-title img {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 20px;
        margin: auto;
        opacity: 0.5
    }

    .popup-review-content {
        text-align: text;
        padding: 20px;
    }

    .popup-review-content input {
        max-width: 250px;
        margin-bottom: 20px
    }

    .popup-review-content textarea {
        margin-top: 0;
        margin-bottom: 20px
    }

    .popup-review-content p {
        color: #283F5C
    }

    .popup-review-content .btn.line {
        margin: 0 10px 20px;
        text-transform: capitalize;
        font-weight: 600
    }

    .popup-review-content .btn.line.active {
        border: 2px solid #283F5C
    }

    .popup-review-content.wide {
        padding: 10px 15px
    }

    .popup-review-content.wide .btn.line {
        margin: 0 7px 20px
    }

    .popup-review-content.wide .left {
        margin-left: 10px
    }

    .popup-review-content.wide .right {
        margin-right: 10px
    }
    .popup-modal .ivu-modal{
        min-width: 70vw !important;
    }
    .spin-yellow{
        color: #CCCC00;
        font-size: 24px;
         animation: ani-demo-spin 1s linear infinite;
    }
</style>
