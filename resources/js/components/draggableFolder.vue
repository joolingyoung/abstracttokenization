<template>
<div class="w-full">
    <draggable class="dragArea" tag="ul" :move="moved" :list="subdata" :group="{ name: 'g1' }">
        <Row type="flex">
            <Collapse v-model="folders" @on-change="Opened" accordion>
                <vue-context ref="rootmenu" class="rootMenu">
                    <li>
                        <a href="#" @click.prevent="shareRoot(company)">
                            <Icon type="md-share" style="margin-right:20px;" /> <span> Share Folder</span></a>
                    </li>
                </vue-context>
                <a class="panel-folders-root" @contextmenu.prevent="$refs.rootmenu.open(company)" style="margin-bottom:10px">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve" class="r-folder">
                        <g>
                            <path style="fill:#283F5C" d="M55.981,54.5H2.019C0.904,54.5,0,53.596,0,52.481V20.5h58v31.981C58,53.596,57.096,54.5,55.981,54.5z  " data-original="#EFCE4A" class="" data-old_color="#EFCE4A" />
                            <path style="fill:#324C6C" d="M26.019,11.5V5.519C26.019,4.404,25.115,3.5,24,3.5H2.019C0.904,3.5,0,4.404,0,5.519V10.5v10h58  v-6.981c0-1.115-0.904-2.019-2.019-2.019H26.019z" data-original="#EBBA16" class="active-path" data-old_color="#EBBA16" />
                        </g>
                    </svg>
                    <span class="f-name">{{company ? company.name : ''}}</span>
                </a>
                 <br/> <br/>
                <Panel class="panel-folders" v-for="(path, index) in subdata" :key="path.name" :name="'folder_'+index" ref="uploads" v-bind:class="{ 'dragover': dragTrue }">
                    <label v-show="!path.edit" :style="[path.type ? {'font-weight' : 'bold'} : '']" @contextmenu.prevent="$refs.menu.open($event, { path, index })">
                        <svg v-if="path.type" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve" class="b-folder">
                            <g>
                                <path style="fill:#283F5C" d="M55.981,54.5H2.019C0.904,54.5,0,53.596,0,52.481V20.5h58v31.981C58,53.596,57.096,54.5,55.981,54.5z  " data-original="#EFCE4A" class="" data-old_color="#EFCE4A" />
                                <path style="fill:#324C6C" d="M26.019,11.5V5.519C26.019,4.404,25.115,3.5,24,3.5H2.019C0.904,3.5,0,4.404,0,5.519V10.5v10h58  v-6.981c0-1.115-0.904-2.019-2.019-2.019H26.019z" data-original="#EBBA16" class="active-path" data-old_color="#EBBA16" />
                            </g>
                        </svg>
                        <span class="f-name">{{ path.name }}</span>
                    </label>
                    <p slot="content">
                        <draggable-file @moved="moved" @loadFiles="lf" :data="path.data" />
                    </p>
                </Panel>
                <vue-context ref="menu">
                    <template slot-scope="child" v-if="child.data">
                        <li v-if="child.data.path.name.split('.').pop() !== 'dd'">
                            <a href="#" @click.prevent="share(child.data.index,child.data.path)">
                                <Icon type="md-share" style="margin-right:20px;" /> <span> Share Folder</span></a>
                        </li>
                    </template>
                </vue-context>
            </Collapse>
        </Row>
    </draggable>
    <Modal v-model="shareActive" class="share-list">
        <div slot="header">
            <p>
                Share Folder
            </p>
            <p style="font-weight:normal; font-size:13px; margin-top:-10px;">Find below a view only link for {{ active.name }}</p>
        </div>
        <Row v-if="loadingShare" class="text-center">
            <span>
                <Icon type="ios-loading" class="upload-spin-icon-load" /> </span>
            Generating a shareable link
        </Row>
        <Row type="flex" justify="center" v-else>
            <Input placeholder="Copy Share File Link" ref="selectShare" v-model="copyLink" />
            <Button @click="copyShareFunction" type="primary" class="sh-button" v-clipboard:copy="copyLink">
                <Icon type="ios-copy-outline" />
                {{textCopy}}</Button>
        </Row>
        <span slot="footer"></span>
    </Modal>
</div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
import draggable from "vuedraggable";
import {
    directive as onClickaway
} from 'vue-clickaway';
import {
    VueContext
} from 'vue-context';
import VueClipboard from 'vue-clipboard2';
Vue.use(VueClipboard)
export default {
    directives: {
        onClickaway: onClickaway
    },
    props: ['data', 'txtindex', 'company'],
    data() {
        return {
            list: [],
            files: [],
            active: {
                name: '',
                list: ''
            },
            dragAndDropCapable: false,
            dragTrue: false,
            subdata: [],
            value: '',
            refresh: 1,
            content: 'Diligence list here, preview only',
            customToolbar: [],
            editor: false,
            clickCount: 0,
            clickTimer: null,
            docindex: 1,
            folders: '1',
            shareActive: false,
            loadingShare: false,
            copyLink: '',
            textCopy: 'Copy',
            rootFolder: '1'
        }
    },
    components: {
        draggable,
        VueContext
    },
    watch: {
        data: function (n, o) {
            this.subdata = n
        },
        subdata: function (val) {
            this.setDragFunction()
        },
        txtindex: function (val) {
            // this.openEditor(val)
        }
    },
    created() {
        this.subdata = this.data
    },
    methods: {
        setDragFunction() {
            this.dragAndDropCapable = this.determineDragAndDropCapable();
            if (this.dragAndDropCapable) {
                for (const key in this.subdata) {
                    if (this.subdata.hasOwnProperty(key)) {
                        if (this.subdata[key].type) {
                            // Drag actions, 'drag', 'dragstart', 'dragend',
                            this.$refs.uploads[key].$el.addEventListener('dragover', function (e) {
                                this.$refs.uploads[key].$el.style.border = "1px dashed #283F5C"
                                e.preventDefault();
                                e.stopPropagation();
                            }.bind(this), false);

                            this.$refs.uploads[key].$el.addEventListener('dragenter', function (e) {
                                this.$refs.uploads[key].$el.style.border = "1px dashed #283F5C"
                                e.preventDefault();
                                e.stopPropagation();
                            }.bind(this), false);

                            this.$refs.uploads[key].$el.addEventListener('dragleave', function (e) {
                                this.$refs.uploads[key].$el.style.border = "none"
                                this.$refs.uploads[key].$el.style.borderBottom = "1px solid #dcdee2"
                                e.preventDefault();
                                e.stopPropagation();
                            }.bind(this), false);

                            this.$refs.uploads[key].$el.addEventListener('drop', function (e) {
                                this.$refs.uploads[key].$el.style.border = "none"
                                this.$refs.uploads[key].$el.style.borderBottom = "1px solid #dcdee2"
                                e.preventDefault();
                                e.stopPropagation();
                            }.bind(this), false);

                            this.$refs.uploads[key].$el.addEventListener('drop', function (e) {
                                for (let i = 0; i < e.dataTransfer.files.length; i++) {
                                    this.files.push(e.dataTransfer.files[i]);
                                }
                                this.submitFiles(key);
                            }.bind(this));
                        }
                    }
                }
            }
        },
        moved: function (evt) {
            this.$emit('moved', evt)
        },
        edit: function (index) {
            this.$emit('done', this.data)
            this.data[index].edit = true
            this.value = this.data[index].name
        },
        rename: function (index) {
            if (this.value !== '') {
                this.data[index].name = this.value
                this.data[index].edit = false
                this.value = this.data[index].name
            } else {
                this.data[index].edit = false
                this.value = this.data[index].name
            }
            this.$emit('done', this.data)
        },
        determineDragAndDropCapable() {
            var div = document.createElement('div');
            return (('draggable' in div) ||
                    ('ondragstart' in div && 'ondrop' in div)) &&
                'FormData' in window &&
                'FileReader' in window;
        },

        getImagePreviews() {
            for (let i = 0; i < this.files.length; i++) {
                if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
                    let reader = new FileReader();
                    reader.addEventListener("load", function () {
                        this.$refs['preview' + parseInt(i)][0].src = reader.result;
                    }.bind(this), false);
                    reader.readAsDataURL(this.files[i]);
                } else {
                    this.$nextTick(function () {
                        this.$refs['preview' + parseInt(i)][0].src = '/images/file.png';
                    });
                }
            }
        },
        uploadFile() {
            axios.post(config.boxCreateFolder, {
                    name: name,
                    parent: parent
                })
                .then(function (resp) {
                    if (name === 'Investor Documents') {
                        self.displayAllFiles(parent)
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getFolderItems(parent) {
            return axios.get(config.boxFolderItems + parent)
                .then(function (resp) {
                    return resp.data.response.entries.map(function (file) {
                        return {
                            id: file.id,
                            name: file.name,
                            edit: false,
                            list: ''
                        }
                    });
                });
        },
        loadingFiles() {
            this.$Message.loading({
                content: 'Loading Files...',
                duration: 0
            });
        },
        lf(val) {
            this.$emit('loadFiles', val)
        },
        Opened(i) {
            var self = this
            if (i.length > 0) {
                let index = i[0].split('_')[1]
                if (self.subdata[index].data.length < 2) {
                    self.$emit('loadFiles', {
                        load: true,
                        txt: 'Loading Files...'
                    })
                    self.getFolderItems(self.subdata[index].id)
                        .then(function (response) {
                            response.forEach(el => {
                                self.subdata[index].data.push(el)
                            });
                            self.$emit('updateList', self.subdata)
                            self.$emit('loadFiles', {
                                load: false,
                                txt: 'Loading Files...'
                            })
                        }).catch(function (error) {})
                }
            }
        },
        share: function (index, path) {
            var self = this
            self.loadingShare = true
            self.active = this.subdata[index]
            self.shareActive = true
            axios.get(config.boxShareFolder + path.id)
                .then(function (res) {
                    self.copyLink = res.data.response.shared_link.url
                    self.loadingShare = false
                })
                .catch(function (error) {});
        },
        shareRoot: function (company) {
            var self = this
            self.loadingShare = true
            self.active.name = company.name
            self.shareActive = true
            axios.get(config.boxShareFolder + company.id)
                .then(function (res) {
                    self.copyLink = res.data.response.shared_link.url
                    self.loadingShare = false
                })
                .catch(function (error) {});
        },
        copyShareFunction() {
            try {
                var self = this
                self.textCopy = 'Copied'
                setTimeout(function () {
                    self.textCopy = 'Copy'
                }, 3000);
            } catch (err) {

            }
        },
        submitFiles(e) {
            let formData = new FormData();
            this.folders = 'folder_' + e;
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                this.subdata[e].data.push({
                    name: file.name,
                    edit: false,
                    status: 'uploading'
                });
                formData.append('files[' + i + ']', file)
                formData.append('name', file.name)
            }
            formData.append('parent', this.subdata[e].id)
            var self = this
            const configuration = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            axios.post(config.boxFileUpload, formData, configuration)
                .then(function (res) {
                    if (res.data.response[0].code === '"item_name_in_use"') {
                        // Todo Replace Same Named File
                    } else {
                        for (const key in self.subdata[e].data) {
                            if (self.subdata[e].data.hasOwnProperty(key)) {
                                let k = key + 1
                                let l = self.subdata[e].data.length - k
                                if (self.subdata[e].data[l].name === res.data.response[key].entries[0].name) {
                                    self.subdata[e].data[l].id = res.data.response[key].entries[0].id
                                }
                                self.subdata[e].data[l].status === 'uploading' ? self.subdata[e].data[l].status = 'uploaded' : ''
                            }
                        }
                    }
                    self.$emit('updateList', self.subdata)
                })
                .catch(function (error) {});
            this.files = [];
        }
    },
    name: "draggable-folder"
};
</script>

<style>
.rootMenu{
    position: absolute !important;
    margin: 15px 0 0 50px!important;
}
.dragArea {
    width: 100%;
    min-height: 20px;
}

.dragArea .ivu-icon-ios-folder-open {
    font-size: 2.2em;
    color: #293F5C;
}

.dragArea .ivu-icon-ios-paper-outline {
    font-size: 1.8em;
}

.dragArea input,
.ivu-modal-header input {
    color: #283F5C;
    outline: none !important;
    box-shadow: none !important;
    font-size: 12px !important;
    border: solid 1px #eee !important;
    padding: 5px 10px !important;
}

.ivu-modal-header p,
.ivu-modal-header-inner {
    height: 30px !important;
}

.dragArea label {
    color: #283F5C;
    font-size: '1em';
}

.list-dd li {
    list-style: none;
    padding-left: 20px !important;
    border-bottom: solid 1px #f1f1f1;
    padding: 10px 0 !important;
    color: #000000 !important;
}

.w-full {
    width: 93% !important;
}

.dd-list i {
    font-size: 22px;
    margin-right: 15px;
}

.dd-list .ivu-modal-header p,
.ivu-modal-header-inner {
    height: 20px !important;
}

.dd-list .ivu-modal-header {
    padding-bottom: 0 !important;
}

.dd-list .ivu-modal-footer {
    display: none !important;
}

@media (min-width:900px) {
    .dd-list .ivu-modal {
        width: 700px !important;
    }
}

.dd-list .ivu-modal-body {
    height: 400px !important;
    overflow-y: scroll !important;
}

.b-folder {
    width: 25px;
    height: auto;
    margin-right: 10px;
    float: left;
}

.r-folder {
    width: 25px;
    height: auto;
    margin-right: 5px;
    margin-top: -3px !important;
    float: left;
}

.panel-folders {
    margin-bottom: 10px;
    padding: 10px;
    border-bottom: 1px solid #dcdee2;
    margin-right: 10px;
    margin-left: 30px;
    cursor: pointer;
}

.panel-folders-root {
    padding: 10px;
    margin-right: 10px;
    cursor: pointer;
    font-weight: bold !important;
    color: #283F5C !important;
}

.panel-folders-root span {
    font-size: 14px !important;
    color: #283F5C !important;
}

.ivu-collapse-header i {
    display: none !important;
}

.panel-folders .f-name {
    font-size: 13px !important;
    color: #283F5C;
    line-height: 24px;
    padding-top: 3px;
}
</style>
