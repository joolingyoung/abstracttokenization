<template>
<div class="dd-list">
    <ul>
        <li v-for="(path, index) in subdata" :key="path.name" @contextmenu.prevent="$refs.menu.open($event, { path, index })">
            <a>
                <span title="Uploading..." v-if="path.status === 'uploading'">
                    <Icon type="ios-loading" class="upload-spin-icon-load" /> </span>
                <label v-show="!path.edit" @click="handleClick(index, path)" :style="[path.type ? {'font-weight' : 'bold'} : '']">
                    <svg v-if="path.name.split('.').pop() !== 'dd'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve" class="b-folder">
                        <g>
                            <polygon style="fill:#E3E3E3" points="51.5,14 37.5,0 6.5,0 6.5,58 51.5,58 " data-original="#EDEADA" class="active-path" data-old_color="#EDEADA" />
                            <polygon style="fill:#283F5C" points="37.5,0 37.5,14 51.5,14 " data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                            <g>
                                <path style="fill:#283F5C" d="M15.5,16h9c0.552,0,1-0.447,1-1s-0.448-1-1-1h-9c-0.552,0-1,0.447-1,1S14.948,16,15.5,16z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M32.5,36h-17c-0.552,0-1,0.447-1,1s0.448,1,1,1h17c0.552,0,1-0.447,1-1S33.052,36,32.5,36z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M42.5,29h-7c-0.552,0-1,0.447-1,1s0.448,1,1,1h7c0.552,0,1-0.447,1-1S43.052,29,42.5,29z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M15.5,24h5c0.552,0,1-0.447,1-1s-0.448-1-1-1h-5c-0.552,0-1,0.447-1,1S14.948,24,15.5,24z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M30.5,24h7c0.552,0,1-0.447,1-1s-0.448-1-1-1h-7c-0.552,0-1,0.447-1,1S29.948,24,30.5,24z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M24.5,23c0,0.26,0.11,0.52,0.29,0.71C24.98,23.89,25.24,24,25.5,24c0.26,0,0.52-0.11,0.71-0.29   c0.18-0.19,0.29-0.45,0.29-0.71c0-0.261-0.11-0.521-0.29-0.71c-0.37-0.37-1.04-0.37-1.42,0C24.61,22.479,24.5,22.739,24.5,23z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M20.5,29c-0.552,0-1,0.447-1,1s0.448,1,1,1h10c0.552,0,1-0.447,1-1s-0.448-1-1-1H20.5z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M15.5,31c0.26,0,0.52-0.11,0.71-0.29c0.18-0.19,0.29-0.45,0.29-0.71c0-0.261-0.11-0.521-0.29-0.71   c-0.37-0.37-1.05-0.37-1.42,0c-0.18,0.189-0.29,0.439-0.29,0.71c0,0.26,0.11,0.52,0.29,0.71C14.98,30.89,15.24,31,15.5,31z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M42.5,43h-7c-0.552,0-1,0.447-1,1s0.448,1,1,1h7c0.552,0,1-0.447,1-1S43.052,43,42.5,43z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M30.5,43h-10c-0.552,0-1,0.447-1,1s0.448,1,1,1h10c0.552,0,1-0.447,1-1S31.052,43,30.5,43z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M14.79,43.29c-0.18,0.18-0.29,0.439-0.29,0.71c0,0.27,0.1,0.52,0.29,0.71   C14.98,44.89,15.24,45,15.5,45c0.27,0,0.52-0.11,0.71-0.29c0.18-0.19,0.29-0.45,0.29-0.71c0-0.271-0.11-0.521-0.29-0.7   C15.84,42.92,15.17,42.92,14.79,43.29z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M42.5,24c0.26,0,0.52-0.11,0.71-0.29c0.19-0.19,0.29-0.45,0.29-0.71c0-0.261-0.1-0.521-0.29-0.71   c-0.38-0.37-1.04-0.37-1.42,0c-0.18,0.189-0.29,0.449-0.29,0.71c0,0.26,0.11,0.52,0.29,0.71C41.98,23.89,42.24,24,42.5,24z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M38.21,37.71c0.18-0.19,0.29-0.45,0.29-0.71c0-0.261-0.11-0.521-0.29-0.71   c-0.38-0.37-1.05-0.37-1.42,0c-0.18,0.189-0.29,0.449-0.29,0.71c0,0.26,0.11,0.52,0.29,0.71C36.98,37.899,37.23,38,37.5,38   S38.02,37.89,38.21,37.71z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                                <path style="fill:#283F5C" d="M41.79,36.29c-0.18,0.189-0.29,0.449-0.29,0.71c0,0.26,0.11,0.52,0.29,0.71   C41.98,37.89,42.23,38,42.5,38s0.52-0.11,0.71-0.29c0.18-0.19,0.29-0.45,0.29-0.71c0-0.261-0.11-0.521-0.29-0.71   C42.84,35.92,42.16,35.92,41.79,36.29z" data-original="#CEC9AE" class="" data-old_color="#CEC9AE" />
                            </g>
                        </g>
                    </svg>
                    <svg v-else version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bulb">
                        <path style="fill:#FFD15C;" d="M314.667,391.467c6.4-21.333,19.2-40.533,36.267-55.467c32-26.667,52.267-67.2,52.267-112
	c0-83.2-69.333-151.467-154.667-147.2C172.8,80,110.933,144,108.8,219.733C107.733,266.667,128,308.267,161.067,336
	C179.2,350.933,192,370.133,198.4,391.467L314.667,391.467L314.667,391.467z" />
                        <path style="fill:#FFFFFF;" d="M242.133,393.6h9.6l-42.667-158.933c1.067,0,2.133,0,3.2,0c5.333,0,10.667-2.133,14.933-6.4
	c2.133-2.133,4.267-3.2,7.467-3.2c3.2,0,5.333,1.067,7.467,3.2c7.467,8.533,20.267,8.533,27.733,0c2.133-2.133,4.267-3.2,7.467-3.2
	c2.133,0,5.333,1.067,7.467,3.2c4.267,4.267,8.533,6.4,14.933,6.4c1.067,0,2.133,0,3.2,0l-41.6,158.933h9.6l43.733-166.4
	c0-2.133,0-4.267-2.133-5.333c-2.133-1.067-4.267,0-5.333,1.067c-2.133,2.133-4.267,3.2-6.4,3.2c-3.2,0-5.333-1.067-8.533-3.2
	c-4.267-4.267-8.533-6.4-13.867-6.4s-9.6,2.133-13.867,6.4s-10.667,4.267-14.933,0c-3.2-4.267-8.533-6.4-13.867-6.4l0,0
	c-5.333,0-10.667,2.133-13.867,6.4c-2.133,2.133-5.333,3.2-8.533,3.2c-2.133,0-5.333-1.067-6.4-3.2
	c-1.067-1.067-3.2-2.133-5.333-1.067c-2.133,1.067-3.2,3.2-2.133,5.333L242.133,393.6z" />
                        <g>
                            <path style="fill:#344A5E;" d="M222.933,489.6C228.267,502.4,241.067,512,256,512c14.933,0,27.733-9.6,33.067-22.4H222.933z" />
                            <path style="fill:#344A5E;" d="M295.467,490.667H217.6c-10.667,0-19.2-8.533-19.2-19.2V390.4h116.267v81.067

C314.667,482.133,306.133,490.667,295.467,490.667z" />
                        </g>
                        <g>
                            <path style="fill:#415A6B;" d="M313.6,430.933H198.4c-6.4,0-11.733-5.333-11.733-11.733l0,0c0-6.4,5.333-11.733,11.733-11.733

h115.2c6.4,0,11.733,5.333,11.733,11.733l0,0C325.333,425.6,320,430.933,313.6,430.933z" />
                            <path style="fill:#415A6B;" d="M313.6,468.267H198.4c-6.4,0-11.733-5.333-11.733-11.733l0,0c0-6.4,5.333-11.733,11.733-11.733

h115.2c6.4,0,11.733,5.333,11.733,11.733l0,0C325.333,462.933,320,468.267,313.6,468.267z" />
                        </g>
                        <g>
                            <path style="fill:#FFD15C;" d="M256,0c-5.333,0-10.667,4.267-10.667,10.667v36.267c0,5.333,4.267,10.667,10.667,10.667

c6.4,0,10.667-4.267,10.667-10.667V10.667C266.667,4.267,261.333,0,256,0z" />
                            <path style="fill:#FFD15C;" d="M113.067,65.067c-4.267-4.267-10.667-4.267-14.933,0s-4.267,10.667,0,14.933l25.6,25.6

c4.267,4.267,10.667,4.267,14.933,0s4.267-10.667,0-14.933L113.067,65.067z" />
                            <path style="fill:#FFD15C;" d="M80,212.267H43.733c-5.333,0-10.667,4.267-10.667,10.667l0,0c0,5.333,4.267,10.667,10.667,10.667H80

c5.333,0,10.667-4.267,10.667-10.667l0,0C90.667,217.6,85.333,212.267,80,212.267z" />
                            <path style="fill:#FFD15C;" d="M123.733,340.267l-25.6,25.6c-4.267,4.267-4.267,10.667,0,14.933s10.667,4.267,14.933,0l25.6-25.6

c4.267-4.267,4.267-10.667,0-14.933S128,336,123.733,340.267z" />
                            <path style="fill:#FFD15C;" d="M388.267,340.267C384,336,377.6,336,373.333,340.267c-4.267,4.267-4.267,10.667,0,14.933l25.6,25.6

c4.267,4.267,10.667,4.267,14.933,0s4.267-10.667,0-14.933L388.267,340.267z" />
                            <path style="fill:#FFD15C;" d="M468.267,212.267H432c-5.333,0-10.667,4.267-10.667,10.667l0,0c0,5.333,4.267,10.667,10.667,10.667

h36.267c5.333,0,10.667-4.267,10.667-10.667l0,0C478.933,217.6,474.667,212.267,468.267,212.267z" />
                            <path style="fill:#FFD15C;" d="M398.933,65.067l-25.6,25.6c-4.267,4.267-4.267,10.667,0,14.933c4.267,4.267,10.667,4.267,14.933,0

l25.6-25.6c4.267-4.267,4.267-10.667,0-14.933S403.2,60.8,398.933,65.067z" />
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                    </svg>
                    <span class="f-name">{{ path.name }}</span>
                </label>
            </a>
            <draggable-file @moved="moved" :data="path.data" />
        </li>
        <vue-context ref="menu">
            <template slot-scope="child" v-if="child.data">
                <li v-if="child.data.path.name.split('.').pop() === 'dd'">
                    <a href="#" @click.prevent="preview(child.data.index, child.data.path)">
                        <Icon type="ios-eye-outline" /> <span>Preview</span>
                    </a>
                </li>
                <li v-if="child.data.path.name.split('.').pop() === 'dd'">
                    <a href="#" @click.prevent="print(child.data.index, child.data.path)">
                        <Icon type="ios-print-outline" /> <span>Print</span>
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="download(child.data.index,child.data.path)">
                        <Icon type="ios-cloud-download-outline" /> <span>Download</span></a>
                </li>
                <li v-if="child.data.path.name.split('.').pop() !== 'dd'">
                    <a href="#" @click.prevent="share(child.data.index,child.data.path)">
                        <Icon type="ios-share-alt-outline" /> <span>Share</span></a>
                </li>
                <li v-if="child.data.path.name.split('.').pop() !== 'dd'">
                    <a href="#" @click.prevent="createFolder">
                        <Icon type="ios-create-outline" /> <span>Rename</span>
                    </a>
                </li>
                <li v-if="child.data.path.name.split('.').pop() !== 'dd'">
                    <a href="#" @click.prevent="removeFile(child.data.index, child.data.path)">
                        <Icon type="ios-trash-outline" /> <span>Remove</span></a>
                </li>
            </template>
        </vue-context>
    </ul>
    <Modal v-model="editor" class="dd-list">
        <div slot="header">
            <p>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bulb">
                    <path style="fill:#FFD15C;" d="M314.667,391.467c6.4-21.333,19.2-40.533,36.267-55.467c32-26.667,52.267-67.2,52.267-112
	c0-83.2-69.333-151.467-154.667-147.2C172.8,80,110.933,144,108.8,219.733C107.733,266.667,128,308.267,161.067,336
	C179.2,350.933,192,370.133,198.4,391.467L314.667,391.467L314.667,391.467z" />
                    <path style="fill:#FFFFFF;" d="M242.133,393.6h9.6l-42.667-158.933c1.067,0,2.133,0,3.2,0c5.333,0,10.667-2.133,14.933-6.4
	c2.133-2.133,4.267-3.2,7.467-3.2c3.2,0,5.333,1.067,7.467,3.2c7.467,8.533,20.267,8.533,27.733,0c2.133-2.133,4.267-3.2,7.467-3.2
	c2.133,0,5.333,1.067,7.467,3.2c4.267,4.267,8.533,6.4,14.933,6.4c1.067,0,2.133,0,3.2,0l-41.6,158.933h9.6l43.733-166.4
	c0-2.133,0-4.267-2.133-5.333c-2.133-1.067-4.267,0-5.333,1.067c-2.133,2.133-4.267,3.2-6.4,3.2c-3.2,0-5.333-1.067-8.533-3.2
	c-4.267-4.267-8.533-6.4-13.867-6.4s-9.6,2.133-13.867,6.4s-10.667,4.267-14.933,0c-3.2-4.267-8.533-6.4-13.867-6.4l0,0
	c-5.333,0-10.667,2.133-13.867,6.4c-2.133,2.133-5.333,3.2-8.533,3.2c-2.133,0-5.333-1.067-6.4-3.2
	c-1.067-1.067-3.2-2.133-5.333-1.067c-2.133,1.067-3.2,3.2-2.133,5.333L242.133,393.6z" />
                    <g>
                        <path style="fill:#344A5E;" d="M222.933,489.6C228.267,502.4,241.067,512,256,512c14.933,0,27.733-9.6,33.067-22.4H222.933z" />
                        <path style="fill:#344A5E;" d="M295.467,490.667H217.6c-10.667,0-19.2-8.533-19.2-19.2V390.4h116.267v81.067

C314.667,482.133,306.133,490.667,295.467,490.667z" />
                    </g>
                    <g>
                        <path style="fill:#415A6B;" d="M313.6,430.933H198.4c-6.4,0-11.733-5.333-11.733-11.733l0,0c0-6.4,5.333-11.733,11.733-11.733

h115.2c6.4,0,11.733,5.333,11.733,11.733l0,0C325.333,425.6,320,430.933,313.6,430.933z" />
                        <path style="fill:#415A6B;" d="M313.6,468.267H198.4c-6.4,0-11.733-5.333-11.733-11.733l0,0c0-6.4,5.333-11.733,11.733-11.733

h115.2c6.4,0,11.733,5.333,11.733,11.733l0,0C325.333,462.933,320,468.267,313.6,468.267z" />
                    </g>
                    <g>
                        <path style="fill:#FFD15C;" d="M256,0c-5.333,0-10.667,4.267-10.667,10.667v36.267c0,5.333,4.267,10.667,10.667,10.667

c6.4,0,10.667-4.267,10.667-10.667V10.667C266.667,4.267,261.333,0,256,0z" />
                        <path style="fill:#FFD15C;" d="M113.067,65.067c-4.267-4.267-10.667-4.267-14.933,0s-4.267,10.667,0,14.933l25.6,25.6

c4.267,4.267,10.667,4.267,14.933,0s4.267-10.667,0-14.933L113.067,65.067z" />
                        <path style="fill:#FFD15C;" d="M80,212.267H43.733c-5.333,0-10.667,4.267-10.667,10.667l0,0c0,5.333,4.267,10.667,10.667,10.667H80

c5.333,0,10.667-4.267,10.667-10.667l0,0C90.667,217.6,85.333,212.267,80,212.267z" />
                        <path style="fill:#FFD15C;" d="M123.733,340.267l-25.6,25.6c-4.267,4.267-4.267,10.667,0,14.933s10.667,4.267,14.933,0l25.6-25.6

c4.267-4.267,4.267-10.667,0-14.933S128,336,123.733,340.267z" />
                        <path style="fill:#FFD15C;" d="M388.267,340.267C384,336,377.6,336,373.333,340.267c-4.267,4.267-4.267,10.667,0,14.933l25.6,25.6

c4.267,4.267,10.667,4.267,14.933,0s4.267-10.667,0-14.933L388.267,340.267z" />
                        <path style="fill:#FFD15C;" d="M468.267,212.267H432c-5.333,0-10.667,4.267-10.667,10.667l0,0c0,5.333,4.267,10.667,10.667,10.667

h36.267c5.333,0,10.667-4.267,10.667-10.667l0,0C478.933,217.6,474.667,212.267,468.267,212.267z" />
                        <path style="fill:#FFD15C;" d="M398.933,65.067l-25.6,25.6c-4.267,4.267-4.267,10.667,0,14.933c4.267,4.267,10.667,4.267,14.933,0

l25.6-25.6c4.267-4.267,4.267-10.667,0-14.933S403.2,60.8,398.933,65.067z" />
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                </svg> {{ active.name }}
            </p>
            <p style="font-weight:normal; font-size:13px; margin-top:-10px; padding-left:40px;">Find all items needed to satisfty this category’s diligence below.</p>
        </div>
        <!-- <vue-editor v-model="data[0].list" :editor-toolbar="customToolbar"></vue-editor> -->
        <ul>
            <li v-for="(i, index) in active.list" :key="index" class="list-dd">
                {{i}}
            </li>
        </ul>
        <span slot="footer"></span>
    </Modal>
    <Modal v-model="shareActive" class="share-list">
        <div slot="header">
            <p>
                Share File
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
            <Button 
                @click="copyShareFunction"
                type="primary"
                class="sh-button"
                v-clipboard:copy="copyLink">
                <Icon type="ios-copy-outline" /> 
                {{textCopy}}</Button>
        </Row>
        <span slot="footer"></span>
    </Modal>
</div>
</template>

<script>
import Vue from 'vue';
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
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
Vue.use(VueClipboard)
export default {
    directives: {
        onClickaway: onClickaway
    },
    props: ['data', 'txtindex'],
    data() {
        return {
            active: {
                name: '',
                list: ''
            },
            subdata: [],
            value: '',
            refresh: 1,
            content: 'Diligence list here, preview only',
            customToolbar: [],
            editor: false,
            clickCount: 0,
            clickTimer: null,
            docindex: 1,
            shareActive: false,
            loadingShare: false,
            copyLink: '',
            textCopy: 'Copy'
        }
    },
    components: {
        draggable,
        VueContext
    },
    watch: {
        data: function (val) {
            this.subdata = val
            //selectShare
        },
        txtindex: function (val) {
            this.openEditor(val)
        }
    },
    created() {
        this.subdata = this.data
    },
    methods: {
        moved: function (evt) {
            this.$emit('moved', evt)
        },
        handleClick: function (index, path) {
            if (path.name.split('.').pop() === 'dd') {
                this.clickCount++
                if (this.clickCount === 1) {
                    this.clickTimer = setTimeout(() => {
                        this.clickCount = 0
                        this.preview(index, path)
                    }, 450)
                }
                if (this.clickCount === 2) {
                    // this.edit(index)
                    //  clearTimeout(this.clickTimer)
                    this.clickCount = 0
                }
            }
        },
        preview: function (index, path) {
            if (!path.type) {
                this.active = this.subdata[index]
                this.editor = true
            }
        },
        downloadFile: function (x) {
            axios({
                url: x,
                method: 'GET',
                responseType: 'blob', // important
            }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'file.pdf');
                document.body.appendChild(link);
                link.click();
            });
        },
        share: function (index, path) {
            var self = this
            self.loadingShare = true
            self.active = this.subdata[index]
            self.shareActive = true
            axios.get(config.boxDownloadFile + path.id)
                .then(function (res) {
                    self.copyLink = res.data
                    self.loadingShare = false
                })
                .catch(function (error) {});
        },
        download: function (index, path) {
            var self = this
            if (path.name.split('.').pop() === 'dd') {
                let docDefinition = this.generateDDPDF(index, path)
                pdfMake.createPdf(docDefinition).download(`${path.name.split('.')[0]}.pdf`)
            } else {
                self.$emit('loadFiles', {load: true, txt: 'Preparing Download...'})
                axios.get(config.boxDownloadFile + path.id)
                    .then(function (res) {
                        self.$emit('loadFiles', {load: true, txt: 'Download Ready'})
                        window.open(res.data)
                        self.$emit('loadFiles', {load: false, txt: ''})
                    })
                    .catch(function (error) {});
            }
        },
        copyShareFunction() {
            try {
                var self = this
                self.textCopy = 'Copied'
                setTimeout(function(){ self.textCopy = 'Copy' }, 3000);
            } catch (err) {

            }
        },
        print: function (index, path) {
            let printwindow = window.open('', 'PRINT', 'height=600,width=800');
            let list = []
            path.list.forEach(a => {
                list.push(`<p><li>${a}</li></p>`)
            });

            printwindow.document.write('<html><head><title>' + path.name.split('.')[0] + '</title>');
            printwindow.document.write('</head><body>');
            printwindow.document.write('<img src="/img/abstract-logo.svg" style="width: 120px; height: auto;" />');
            printwindow.document.write('<h2>' + path.name.split('.')[0] + '</h2><p>Find all items needed to satisfy this category’s diligence below.</p>');
            printwindow.document.write(list.join(''));
            printwindow.document.write('</body></html>');

            printwindow.document.close(); // necessary for IE >= 10
            printwindow.focus(); // necessary for IE >= 10*/

            printwindow.print();
            printwindow.close();

            return true;
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
        removeFile(index, path) {
            this.subdata.splice(index, 1);
            axios.get(config.boxFileDelete + path.id)
                .then(function (res) {});
        },
        generateDDPDF: function (index, path) {
            let list = []
            path.list.forEach(a => {
                list.push({
                    text: a,
                    margin: [0, 10, 0, 10]
                })
            });
            return {
                content: [{
                        image: 'data:/png;base64,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',
                        width: 120
                    },
                    {
                        text: path.name.split('.')[0],
                        fontSize: 25,
                        margin: [0, 15, 0, 5]
                    },
                    {
                        text: 'Find all items needed to satisfy this category’s diligence below.',
                        margin: [0, 0, 0, 20]
                    },
                    {
                        ul: list
                    }
                ]

            }
        }
    },
    name: "draggable-file"
};
</script>

<style>
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

.bulb {
    width: 20px;
    height: auto;
    margin-right: 10px;
    float: left;
}

.upload-spin-icon-load {
    animation: ani-demo-spin 1s linear infinite;
    color: #283F5C !important;
    font-size: 14px !important;
    margin-right: 5px !important;
}

@keyframes ani-demo-spin {
    from {
        transform: rotate(0deg);
    }

    50% {
        transform: rotate(180deg);
    }

    to {
        transform: rotate(360deg);
    }
}

.dragfile li {
    margin: 0 !important;
}

.v-context {
    min-width: 250px !important;
    outline: 0 !important;
    overflow: hidden !important;
    border: none !important;
    box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2) !important;
}

.v-context a i {
    color: #283F5C;
}

.v-context a span {
    font-weight: 500;
    font-size: 13px;
}

.ivu-input-group-append,
.ivu-input-group>.ivu-input:last-child {
    border-bottom-left-radius: 0 !important;
    border-top-left-radius: 0 !important;
}

.ivu-input-group-append {
    border-left: 0;
}

.ivu-input-group-append,
.ivu-input-group-prepend {
    padding: 4px 7px;
    font-size: inherit;
    font-weight: 400;
    line-height: 1;
    color: #515a6e;
    text-align: center;
    background-color: #f8f8f9;
    border: 1px solid #dcdee2;
    border-radius: 4px;
}

.ivu-input-group-append,
.ivu-input-group-prepend {
    width: 1px;
    white-space: nowrap;
    vertical-align: middle;
}

.ivu-input-group-append,
.ivu-input-group-prepend,
.ivu-input-group>.ivu-input {
    display: table-cell;
}

.share-list input[type="text"] {
    height: 40px !important;
    font-size: 13px !important;
    line-height: 40px !important;
    width: 100% !important;
    float: left !important;
}

.sh-button {
    cursor: pointer;
    padding: 0 16px !important;
    background: #2d8cf0 !important;
    color: #fff !important;
    border-color: #2d8cf0 !important;
    transition: all .2s ease-in-out;
    position: relative;
    z-index: 2;
    height: 40px !important;
    line-height: 40px !important;
    width: 120px !important;
    float: left !important;
    margin-top: 8px !important;
    margin-left: -5px !important;
    font-size: 14px !important;
}
.sh-button:hover {
    background: #2b7cd3 !important;
    border-color: #2b7cd3 !important;
    opacity: 1 !important;
}

.ivu-input-group {
    display: table;
    width: 100%;
    border-collapse: separate;
    position: relative;
    font-size: 14px;
    top: 1px;
}

.ivu-input-wrapper {
    display: inline-block;
    width: calc(100% - 120px) !important;
    position: relative;
    vertical-align: middle;
    line-height: normal;
    float: left !important;
}

.share-list .ivu-modal-body {
    min-height: 80px !important;
}
</style>
