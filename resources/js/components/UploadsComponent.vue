<template>
    <div class="upload-container">
        <div class="uploads-csd">
            <!---
                ----
                    @params accepts
                        type = string | required
                        action = string | required
                        path = string | required
                        title = string | optional
                        icon = string | optional
                ----
            ---->
            <Spin v-if="loader" style="height:100px !important;">
                <Icon type="ios-checkmark-circle-outline" size="22" class="color-green" v-if="sus" />
                <Icon type="ios-loading" size="18" class="spin-icon-load" v-else></Icon>
                <div>{{ loadertext }}</div>
            </Spin>
            <div v-else>
                <Upload
                    :name="elname"
                    :headers="{'X-CSRF-TOKEN': header}"
                    ref="upload"
                    v-if="type === 'single' || type === 'single-dust'"
                    :action="action"
                    :on-progress="progress"
                    :on-success="success"
                    :max-size="2048"
                    :on-exceeded-size="maxSize"
                    :data="payload">
                    <div
                        v-if="elname === 'image'"
                        class="back-lay"
                        v-bind:class="{ 'blur-bg': src != '' }"
                        :style="[src != '' ? {'background' : 'url(' + src + ')'} : {}]">
                    </div>
                    <!-- @TODO <Button type="primary">Upload</Button> -->
                    <div class="btn dust" v-if="type === 'single-dust'">
                        <!--  -->
                        <span v-if="src !== '' && elname === 'image'">
                            <img :src="src ? src : '/img/icon-upload.svg'">
                        </span>
                        <span v-else>
                            <img v-if="!flat && !sus" :src="src ? src : '/img/icon-upload.svg'">
                        </span>
                        <h5>
                            <!-- <Icon type="md-checkmark" v-if="sus" /> -->
                            <span v-if="src !== '' && elname === 'image'" style="font-weight:normal !important;"></span>
                            <span v-else><span v-if="sus">Re-</span>{{ !title ? 'Upload File' : title }}</span>
                        </h5>
                    </div>
                    <div class="file-upload-box" v-bind:class="{ 'uploadcomplete-img': src !== '' }" v-else>
                        <span v-if="src !== '' && elname === 'image'">
                            <img :src="src ? src : '/img/icon-upload.svg'">
                        </span>
                        <span v-else>
                            <img v-if="!flat && !sus" :src="src ? src : '/img/icon-upload.svg'">
                        </span>
                        <h5>
                            <!-- <Icon type="md-checkmark" v-if="sus && elname !== 'image'" /> -->
                            <span v-if="src !== '' && elname === 'image'"  style="font-weight:normal !important;"></span>
                            <span v-else><span v-if="sus">Re-</span>{{ !title ? 'Upload File' : title }}</span>
                        </h5>
                    </div>
                </Upload>
                <div v-if="type === 'single' || type === 'single-dust'">
                    <li v-if="sus && elname !== 'image'" style="list-style:none !important;">
                        <a><Icon type="md-document" style="margin-right:5px;" /> {{ fileOld.name }}</a>
                    </li>
                </div>

                <Upload
                    :name="elname"
                    :headers="{'X-CSRF-TOKEN': header}"
                    ref="uploadPhotos"
                    v-if="type === 'photos'"
                    :action="action"
                    :on-progress="progress"
                    :on-success="success"
                    :max-size="2048"
                    :on-exceeded-size="maxSize"
                    :data="payload">
                    <div class="photo-upload-box">
                        <img v-if="src" :style="[src ? {'width':'auto', 'height':'100%'} : '']" :src="src">
                    </div>
                </Upload>

                <Upload
                    multiple
                    type="drag"
                    :name="elname"
                    :headers="{'X-CSRF-TOKEN': header}"
                    ref="uploadPhotos"
                    v-if="type === 'multi-drag'"
                    :action="action"
                    :on-progress="progress"
                    :on-success="success"
                    :data="payload">
                    <div style="padding: 20px 0">
                        <Icon type="ios-cloud-upload" size="52" style="color: #283f5c"></Icon>
                        <p><Icon type="md-checkmark" v-if="sus && elname !== 'image'" /> Click or drag files here to upload</p>
                    </div>
                </Upload>
                <Upload
                    :name="elname"
                    :headers="{'X-CSRF-TOKEN': header}"
                    ref="upload"
                    v-if="type === 'text'"
                    :action="action"
                    :on-progress="progress"
                    :on-success="success"
                    :max-size="2048"
                    :on-exceeded-size="maxSize"
                    :data="payload">
                    <a class="upload-text"><Icon type="md-checkmark" v-if="sus && elname !== 'image'" /> {{ !title ? 'Upload File' : title }}</a>
                </Upload>
                <div class="row" v-if="section === 'captable' && type !== 'text'">
                    <br/>
                    <a class="mrg-left-cap" href="/28912SAIAS232/investor-cap-table-upload.xlsx" download>
                        <Icon type="md-cloud-download" /> Cap Table Sample
                    </a>
                </div>
                <input type="hidden" :name="field.replace('-', '_')" :value="src" /> 
            </div>
        </div>
        <div class="row" v-if="section === 'reports' && type !== 'text'">
            <br/>
            <a class="mrg-left-cap" href="/28912SAIAS232/DST Report Upload Template.xlsx" download>
                <Icon type="md-cloud-download" /> Download Report Upload Template
            </a>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
import Cookies from 'js-cookie';
export default {
    props: ['type', 'action', 'title', 'field', 'multi', 'icon', 'flat', 'path', 'elname', 'scope', 'refresh', 'section', 'small', 'clear', 'map','cook'],
    data () {
        return {
            loadertext: 'Uploading file',
            loader: '',
            sus: false,
            header: '',
            src: '',
            fileOld: '',
            payload: {}
        }
    },
    mounted(){
        this.payload = {
            structure: this.path,
            section: this.section,
            access: this.scope,
            multi: this.multi,
            field: this.field,
            map: this.map
        }
        this.header = document.head.querySelector("[name~=csrf-token][content]").content
        if (Cookies.get(this.field + this.cook)) {
            this.src = Cookies.get(this.field + this.cook)
        }
    },
    watch: {
        clear: function (n) {
            if (n === true) {
                this.sus = false
                this.src = ''
            }
        }
    },
    methods: {
        getImage (res) {
            var self = this
            let user =  res.path.indexOf('/') > -1 ? res.path.split('/')[0] : ''

            const url = config.getFiles + '?user=' + user + '&&field=' + res.field + '&&section=' + res.section + '&&sectionid=' + res.section_id

            axios
            .get(url)
            .then(function(resp) {
                resp.data.map(function (x) {
                    if (x.path === res.path) {
                        self.src = x.src
                        if (self.cook) {
                            Cookies.remove(self.field + self.cook);
                            Cookies.set(self.field + self.cook, x.src, {
                                expires: 1
                            })
                            document.getElementById("headerimg").src=x.src
                        }
                    }
                });
            })
            .catch(function(error) {
                return error
            })
        },
        success(res, file) {
            this.fileOld = file;
            if (this.cook) {
                this.getImage(res.response)
            } else {
                this.type === 'photos' ? this.getImage(res.response) : ''
                this.elname === 'image' && !this.flat ? this.getImage(res.response) : ''
            }
            this.sus = true
            this.loadertext = 'File Uploaded'
            var self = this
            setTimeout(function(){
                self.elname === 'image' ? self.sus = false : '';
                self.loader = false;
                self.loadertext = 'Uploading File';
            }, 2000);
            this.refresh === 'true' ? window.location.reload() : ''

            this.$emit('done', res)
        },
        progress (event) {
            this.loader = true
        },
        maxSize(file) {}
    }
}
</script>

<style scoped>
    .dust h5{
        color: #fff;
    }
    .upload-text:hover{
        text-decoration: underline !important;
    }
    .color-green{
        color: #2c9e1d;
    }
    .uploadcomplete-img{
        padding: 0 !important;
        background-size: cover !important;
        height: 161px !important;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        overflow: hidden !important;
    }
    .uploadcomplete-img img{
        position: relative;
        z-index: 2;
        width: 100% !important;
        height: auto !important;
    }
   .uploadcomplete-img .ivu-btn{
        float: right !important;
        background: linear-gradient(135deg,#000 0%,#868686 100%) !important;
        font-size: 16px !important;
        min-width: 100px !important;
        height: 30px !important;
        line-height: 12px !important;
        visibility: hidden !important;
    }
    .uploadcomplete-img:hover .ivu-btn{
        visibility: visible !important;
    }
    .uploads-csd{
        position: relative;
        height: 161px !important;
        border-radius: 3px;
    }
    .uploads-csd span{
        color: #fff !important;
    }
    .blur-bg{
      /* Add the blur effect */
      filter: blur(8px);
      -webkit-filter: blur(8px);
      /* Center and scale the image nicely */
      background-position: center;
      background-size: cover;
    }
    .back-lay{
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .download-sample-cap{
        font-weight: bold;
        font-size: 24px;
    }
    .mrg-left-cap{
        padding: 20px;
    }
</style>
