<template>
<div class="filePreview">
    <Spin v-if="loading && iname !== 'filebutton'">
        <Icon type="ios-loading" size="18" class="spin-icon-load"></Icon>
        <div>{{ loadingtxt }}</div>
    </Spin>
    <div v-if="!loading && iname !== 'filebutton' && !src">
        <div v-if="files.length > 0">
            <!--- Display Static indexes -->
            <div class="row" v-if="iname === 'Digital Security Photo Gallery'">
                <div class="col-xs-12 col-md-6" v-if="files[0]">
                    <div class="porperty-image large margin-bottom-m-md">
                        <div class="image-close" @click="deleteFile(0)"></div><img :src="files[0].src"></div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="row margin-bottom-m">
                        <div class="col-xs-12 col-sm-6" v-if="files[1]">
                            <div class="porperty-image margin-bottom-m-md">
                                <div class="image-close" @click="deleteFile(1)"></div><img :src="files[1].src"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6" v-if="files[2]">
                            <div class="porperty-image">
                                <div class="image-close" @click="deleteFile(2)"></div><img :src="files[2].src"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6" v-if="files[3]">
                            <div class="porperty-image margin-bottom-m-md">
                                <div class="image-close" @click="deleteFile(3)"></div><img :src="files[3].src"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6" v-if="files[4]">
                            <div class="porperty-image">
                                <div class="image-close" @click="deleteFile(4)"></div><img :src="files[4].src"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--- Display Single Images -->
            <img v-if="iname === 'Single'" class="single" :src="files[index].src" id="headerimg" :class="{'image-thumbnail': isthumbnail}" />

            <!--- Display Multiple Images
                @Todo
            -->

            <!--- Download Files -->
            <ul v-if="iname === 'file'">
                <li v-for="(a, i) in files" :key="i">
                    <a :href="a.src" target="_blank" download>{{ a.path ? a.path.split(/[\/ ]+/).pop() : '' }} <Icon type="md-cloud-download" /></a>
                </li>
            </ul>
        </div>
        <Spin v-else>
            <Icon type="ios-cube-outline" size="18" />
            <div>File not found</div>
        </Spin>
    </div>
    <div v-if="iname !== 'filebutton' && src">
         <!--- Display Images -->
         <div v-if="url">
             <img v-if="iname === 'Single'" class="single" :src="url" />
         </div>
         <Spin v-else>
            <Icon type="ios-cube-outline" size="18" />
            <div>File not found</div>
        </Spin>
    </div>
    <a v-if="iname === 'filebutton'" :href="files[0] ? files[0].src : '#not-found'" target="_blank" download>
        <Button class="btn full-width color-white" :loading="loading"> <b style="font-size:14px;">{{ title }}</b></Button></a>
</div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
export default {
    props: ['title', 'user', 'path', 'field', 'scope', 'iname', 'src', 'index', 'sectionid', 'section', 'isthumbnail'],
    data () {
        return {
            url: '',
            files: [],
            loading: true,
            loadingtxt: 'Loading Files, Please Hold On'
        }
    },
    created () {
        var self = this
        const url = self.scope === 'private' ? ( self.user ? ('?user=' + self.user + '&&field=' + self.field + '&&section=' + self.section + '&&sectionid=' + self.sectionid) : false) : 'public?path=' + self.path
        if (url !== false) {
            console.log("fp", url)
            axios
            .get(config.getFiles + url)
            .then(function(resp) {
                self.sortFiles(resp.data)
                self.loading = false
            })
            .catch(function(error) {
                return error
            });
        } else {
            self.loadingtxt = 'Access Denied, File not found'
        }
    },
    methods: {
        sortFiles (e) {
            var self = this
            if (self.sectionid) {
                e.map(function (x) {
                    if (self.sectionid == x.data.section_id) {
                        self.files.push(x)
                    }
                })
            } else{
                self.files = e
            }
        },
        deleteFile (e) {
            var key = e
            this.$Modal.confirm({
                title: 'Delete File Action',
                content: '<p>Are you sure you want to delete this file</p>',
                okText: 'Delete',
                cancelText: 'Cancel',
                onOk: () => {
                    this.removeFile(key);
                },
                onCancel: () => {}
            });
        },
        removeFile (e) {
            var self = this
            if (self.files[e]) {
                self.loadingtxt = 'Deleting file, hold on'
                self.loading = true
                let x = self.files[e].path
                axios
                .get(config.delFile + '?f=' + x)
                .then(function(resp) {
                    self.files.splice(e, 1);
                    self.loading = false
                })
                .catch(function(error) {
                    return error
                });
            }
        }
    }
}
</script>
<style scoped>
    .single{
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .filePreview{
        min-height: 150px;
    }
</style>
