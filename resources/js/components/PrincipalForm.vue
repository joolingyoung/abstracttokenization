<template>
<div>
<Spin v-if="loading">
    <Icon type="ios-loading" size="18" class="spin-icon-load"></Icon>
    <div> {{ loadingtext }} </div>
</Spin>
<div v-else>
<div class="principal-section">
    <Form ref="addPrincipal" :model="create" :rules="ruleValidate" label-position="top" v-if="!preview">
        <!-- <div class="margin-bottom-m border-bottom full-width" v-if="!type">
            <input v-model="check" type="checkbox" class="checkbox-box">
            <div class="checkbox-p">Check this box to quickly add any Principals you have already attached to your account during Abstract’s Account Set Up. <br/>You can also manually add in other Princpals from your team below. </div>
        </div> -->
        <div class="row margin-top-l">
            <div class="col-xs-12 col-sm-4">
                <div class="col-lg-8 no-padding">
                    <uploads
                        type="single"
                        title="Upload Photo"
                        action="/files"
                        elname="image"
                        scope="private"
                        :clear="clear"
                        field="principles"
                        multi="yes"
                        map="principles-files"
                        :path="'/principles/' + mndex + '/'"
                        @done="successUpload"
                        >
                    </uploads>
                </div>
                <br/>
                <div class="content-form">
                    <div class="row">
                        <div class="col-xs-12">
                            <FormItem label="Principal Full Name" prop="name">
                                <Input v-model="create.name"/>
                            </FormItem>
                        </div>
                        <div class="col-xs-12">
                            <FormItem label="Principal Title" prop="title">
                                <Input v-model="create.title"/>
                            </FormItem>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-xs-offset-0 col-sm-offset-1 mrg-push-top">
                <FormItem label="Principal Bio" prop="bio">
                    <textarea name="bio" v-model="create.bio"></textarea>
                </FormItem>
                <div class="btn small margin-principal-m" @click="handlePlus('addPrincipal')">+ Add Principal</div>
            </div>
         </div>
     </Form>

    <Form>
     <div class="push-top-card" :style="[!preview ? {'padding-top' : '60px'} : {}]" v-if="formDynamic.length">
        <div class="card margin-top-m" v-for="(item, index) in formDynamic" :key="index" v-if="item.status">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="file-upload-box-filled">
                            <img :src="item.src" />
                            <br/><br/>
                        </div>
                        <div class="content-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Principal Full Name</p>
                                    <input type="text" @blur.native="handleSubmit('blur')" v-model="item.name">
                                </div>
                                <div class="col-xs-12">
                                    <p>Principal Title</p>
                                    <input type="text" @blur.native="handleSubmit('blur')" v-model="item.title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-offset-1">
                        <p class="no-margin-top">Principal Bio</p>
                        <textarea class="textarea" @blur.native="handleSubmit('blur')" v-model="item.bio"></textarea>
                        <Button :loading="delLoader" @click="handleRemove(index, item.id)" class="btn margin-top-m color-white dust margin-right-m cursor-hand rm-boost"><b>Remove Principal</b></Button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </Form>
</div>
</div>
<div class="row"  v-if="next === 'yes'">
    <div class="col-xs-6 col-sm-6" v-if="back">
        <div class="content-footer">
            <div  class="footer-button-back" @click="handleback()">
                <img src="/img/icon-arrow-back.svg">
                <h5>Back</h5>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div class="content-footer">
            <a @click="handleSubmit('next')" class="btn color-white fl-right">Next</a>
        </div>
    </div>
</div>
<!--
    ### Disable Popoup but maintain it for future use ###
    <popup-component
    v-if="error"
    title="Existing Principles Action"
    type="recurring"
    :user="user"
    info="<h5>You have no existing principles saved. </h5>"
    action="Got It!">
</popup-component> -->
</div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
import uploads from './UploadsComponent'
import previews from './FilePreview'
export default {
    props: ['type', 'next', 'url', 'map', 'data', 'user', 'preview', 'back'],
    components: {
        uploads,
        previews
    },
    data() {
        return {
            check: false,
            mndex: 1,
            delLoader: false,
            loading: false,
            loadingtext: 'Pulling existing principals, hold on',
            formDynamic: [],
            error: false,
            files: [],
            create: {
                bio: '',
                name: '',
                title: '',
                path: '',
                index: 1,
                status: 1
            },
            clear: false,
            ruleValidate: {
                name: [
                    { required: true, message: 'Principal name required', trigger: 'blur' }
                ],
                title: [
                    { required: true, message: 'Principal title required', trigger: 'blur' }
                ],
                bio: [
                    { required: true, message: 'Principal Bio required', trigger: 'blur' },
                    { type: 'string', min: 20, message: 'Introduce no less than 10 words', trigger: 'blur' }
                ]
            }
        }
    },
    watch: {
        check: function (val) {
          val === true ? this.getPrinciples() : ''
        },
        files: function (n, o) {
           this.getPrinciples()
        }
    },
    created () {
        this.getFiles()
    },
    methods: {
        getPrinciples () {
            var self = this
            self.loading = true
            self.loadingtext = 'Pulling principals, hold on'
            axios
            .get(config.getPrinciples)
            .then(function(resp) {
                if (resp.data.status === 200) {
                    let a = resp.data.response
                    self.loading = false
                    a.map(function (x) {
                        x.index = 1
                        x.status = 1
                        for (let key in self.files) {
                            if (self.files[key]) {
                                x.image === self.files[key].path ? x.src = self.files[key].src : ''
                            }
                        }
                        self.formDynamic.push(x)
                    })
                } else {
                    self.loading = false
                }
            })
            .catch(function(error) {
                return error
            })
        },
        getFiles() {
            var self = this
            let x = '?user=' + self.user + '&&field=principles&&section=principles-files'
            axios
            .get(config.getFiles + x)
            .then(function(resp) {
                self.files = resp.data
            })
            .catch(function(error) {
                return error
            });
        },
        successUpload(e) {
            e.response.path ? this.create.path = e.response.path : ''
        },
        handleback () {
            this.back ? window.location.href = this.back : ''
        },
        handlePlus(name) {
            this.$refs[name].validate((valid) => {
                if (valid && this.create.path !== '') {
                    let p = Object.assign({}, this.create)
                    this.create.index = this.mndex
                    this.formDynamic.push(p)
                    this.$refs[name].resetFields()
                    this.mndex++
                    this.clear = true
                    var self = this
                    axios
                        .post(config.postPrinciples, p)
                        .then(function(resp) {
                            self.formDynamic = []
                            self.getFiles()
                        })
                        .catch(function(error) {
                            return error
                        })
                } else {
                    this.$Message.error('All fields are required')
                }
            })
        },
        handleSubmit(e) {
            this.next === 'yes' && e === 'next' ? window.location.href = this.url : ''
        },
        handleReset(name) {
            this.$refs['addPrincipal'].resetFields()
        },
        handleRemove(index, id) {
            this.$Modal.confirm({
                title: 'Delete Principal',
                content: '<p>Are you sure you want to delete Principal</p>',
                okText: 'Delete',
                cancelText: 'Cancel',
                onOk: () => {
                    this.deleteAction(id, index)
                },
                onCancel: () => {}
            })
        },
        deleteAction (id, index) {
            var self = this
            self.formDynamic.splice(index, 1)
            axios
            .delete(config.deletePrinciple, { data: { id: id } })
            .then(function(resp) {}).catch(function(error) {
                return error
            })
        }
    }
}
</script>
<style>
.checkbox-p{
    font-family: "Montserrat" !important;
    color: #283F5C;
    float:left;
    width: calc(100% - 80px);
    margin-top: -8px;
    font-weight: 500;
    line-height: 1.5;
    margin-bottom: 10px !important;
    font-size: 13px !important;
}
.checkbox-box{
    float: left;
    margin-right: 10px;
}
</style>

<style scoped>
.margin-principal-m{
    margin: 20px 0;
}
.fl-right{
    float: right;
}
.remove-principle{
    font-size: 1.5em;
    color: rgb(255, 0, 0);
    cursor: pointer;
}
.push-top-card .card{
     padding: 30px;
}
.push-top-card .card .textarea{
    min-height: 75%;
}
input[type="checkbox"]{
    background: #283F5C;
}
input[type="checkbox"]:checked{
    background: #283F5C url("/img/icon-check-white.svg") no-repeat center !important;
}
.view-principles{
    margin-bottom: 20px !important;
}
.mrg-push-top{
    margin-top: 50px !important;
}
.mrg-push-extra-top{
    margin-top: 200px !important;
}
.mrg-push-mid-top{
    margin-top: 140px !important;
}
.principal-section{
    padding: 10px !important;
}
.rm-boost{
    font-size: 16px;
}
</style>
