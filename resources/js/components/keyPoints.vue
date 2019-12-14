<template>
<div class="full-width">
    <span v-if="error">
        <small class="error-small"><em>*</em> <span> Key deal points required </span></small>
        <br />
    </span>
    <vue-editor v-model="content" :editorToolbar="customToolbar" @blur="saveData('blur')">
        <span v-html="data"></span>
    </vue-editor>
    <div class="row" v-if="next === 'yes'">
        <div class="col-xs-6 col-sm-6" v-if="back">
            <div class="content-footer">
                <div class="footer-button-back" @click="handleback()">
                    <img src="/img/icon-arrow-back.svg">
                    <h5>Back</h5>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6">
            <div class="content-footer">
                <a @click="saveData('submit')" class="btn margin-key-m color-white fl-right" v-if="next === 'yes'">{{nxtext}}</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
import {
    VueEditor
} from 'vue2-editor';
const bbb = '';
export default {
    props: ['data', 'next', 'url', 'back'],
    components: {
        VueEditor
    },
    data() {
        return {
            nxtext: 'Save',
            error: false,
            content: '',
            customToolbar: [
                ["bold", "italic", "underline"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }]
            ]
        };
    },
    render(createElement) {
        return createElement;
    },
    created() {
        this.content = this.data
        if (this.next !== 'yes' && this.content === '') {
            this.error = true
        } else {
            this.error = false
        }
    },
    methods: {
        handleback() {
            this.back ? window.location.href = this.back : ''
        },
        saveData(e) {
            if (this.content != '') {
                var self = this
                axios
                    .post(config.host + self.url, {
                        'key-point': self.content,
                    })
                    .then(function (resp) {
                        self.nxtext = 'Next'
                        setTimeout(function () {
                            resp.request.status === 200 && self.next === 'yes' && e !== 'blur' ? window.location.href = resp.data : ''
                        }, 3000);

                    })
                    .catch(function (error) {
                        return error
                    });
            }
        }
    }
};
</script>

<style>
.full-width {
    width: 100%;
}

.text-right {
    text-align: right !important;
}

.fl-right {
    float: right !important;
}

.margin-key-m {
    margin: 20px 0;
}
</style>
