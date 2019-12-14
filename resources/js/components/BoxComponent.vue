<template>
<div class="full-width">
    <Row type="flex" justify="center" align="middle" v-if="loadFile">
        <div class="ivu-message" style="z-index: 1031;"><div class="ivu-message-notice" style="height: 35px;"><!----> <div class="ivu-message-notice-content"><div class="ivu-message-notice-content-text">
            <div class="ivu-message-custom-content ivu-message-loading">
                <i class="ivu-icon ivu-icon-ios-loading  ivu-load-loop" style="color:#283F5C !important; margin-top:-3px !important;"></i>
                <span style="font-size:12px !important; color:#283F5C !important; padding-top:2px !important;">{{lft}}</span>
            </div>
        </div> <div class="ivu-message-notice-content-text"><!----></div> <!----></div></div><div class="ivu-message-notice" style="height: 35px;"><!----> <div class="ivu-message-notice-content"><div class="ivu-message-notice-content-text">
            <div class="ivu-message-custom-content ivu-message-loading">
                <i class="ivu-icon ivu-icon-ios-loading  ivu-load-loop" style="color:#283F5C !important; margin-top:-3px !important;"></i>
                <span style="font-size:12px !important; color:#283F5C !important;">{{lft}}</span>
            </div>
        </div> <div class="ivu-message-notice-content-text"><!----></div> <!----></div></div></div>
    </Row>
    <Row type="flex" justify="center" align="middle" v-if="loading">
        <Spin>
            <Icon type="ios-loading" size="18" class="spin-icon-load"></Icon>
            <div>{{ loadingtxt }}</div>
        </Spin>
    </Row>
    <div class="full-width" v-else>
        <div class="row drop drop-files">
            <draggable-folder @updateList="updateList" @loadFiles="loadFiles" :struc="struc" :txtindex="txt" :data="list" :company="companyRoot" />
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import config from '../libs'
import Cookies from 'js-cookie';
export default {
    props: ['struc', 'name', 'owner', 'user'],
    name: "box-component",
    display: "Nested",
    order: 15,
    watch: {
        list: function (n, o) {
            Cookies.remove(this.struc);
            Cookies.set(this.struc, n, {
                expires: 364
            })
        }
    },
    data() {
        return {
            list: [],
            loading: true,
            loadFile: false,
            loadingtxt: 'Loading Diligence ...',
            upload: false,
            txt: '',
            ref: 1,
            dragAndDropCapable: false,
            files: [],
            uploadPercentage: 0,
            dragTrue: false,
            root: 1,
            lft: 'Loading Files...',
            companyRoot: ''
        };
    },
    created() {
        this.checkCache()
    },
    methods: {
        checkCache() {
            let a = Cookies.get(this.struc)
            if (a) {
                this.list = JSON.parse(a)
                if (Cookies.get('companyList')) {
                    this.companyRoot = JSON.parse(Cookies.get('companyList'))
                }
                this.loading = false
            } else {
                this.getRootFolder()
            }
        },
        getRootFolder() {
            // Get Root Folder
            var self = this
            axios.get(config.boxRootFolder)
                .then(function (resp) {
                    let a
                    resp.data.response.item_collection.entries.map(function (folder) {
                        folder.name === 'Dilligence' ? a = folder.id : ''
                    })
                    self.checkSponsorDir(a)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        checkSponsorDir(root) {
            // Check Sponsor Dir
            var self = this
            self.loadingtxt = "Checking Sponsor Folder ..."
            axios.get(config.boxFolderItems + root)
                .then(function (resp) {
                    let a = resp.data.response.entries.find(x => x.name === self.owner + self.user)
                    if (a) {
                        self.companyRoot = a
                        self.companyRoot.name = self.owner
                        self.companyRootList(a)
                        self.displayAllFiles(a.id)
                    } else {
                        self.newDDList(self.owner + self.user, root)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        createNewBoxFolder(name, parent) {
            var self = this
            self.loadingtxt = "Creating diligence folders ..."
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
        displayAllFiles(root) {
            // Display Files
            var self = this
            self.loadingtxt = "Arranging Folders ..."
            axios.get(config.boxFolderItems + root)
                .then(function (resp) {
                    const rowLen = resp.data.response.entries.length;
                    resp.data.response.entries.map(function (folder, i) {
                        let dd
                        switch (folder.name) {
                            case 'Deal Documents':
                                dd = ['Purchase Agreement', 'Operating Agreement', 'Private Placement Memorandum']
                                break;
                            case 'Debt Diligence':
                                dd = ['Note', 'Deed of Trust or Mortgage', 'Assignments of Leases / Rents', 'Summary of Loan terms or Loan Commitment']
                                break;
                            case 'Environmental & Property Condition':
                                dd = ['Engineering Inspection & Report', 'Soils Report', 'Environmental Audit', '-Phase I/II']
                                break;
                            case 'Investor Documents':
                                dd = ['Cap Table', 'History of Distributions', 'Period Reports (monthly or quarterly)']
                                break;

                            case 'Financial Diligence':
                                dd = ['Appraisal', 'Financial Statements *Past 3 years', 'Historical Operating Financials', 'Current Rent Roll', 'Lease Analysis', 'Financial Projections Model', 'Argus, *If applicable']
                                break;

                            case 'Legal & Insurance Diligence':
                                dd = ['Ground Lease, *if any', 'Any side agreements with tenants or others', 'Litigation Review', 'Contracts affecting Property', 'Private Placement Memorandum', 'Property Management Agreement', 'Insurance Certificate / Declarations Page', 'Corporate Resolutions of Seller, *if applicable', 'Corporate Certificate of Good Standing', 'Corporate Income Tax Returns for past three years, *if applicable', 'Partnership Agreements, Amendments, & Certificate', 'Partnership Income Tax Returns, *Past 3 years', 'All leases, amendments & rental agreements']
                                break;

                            case 'Title Survey & Zoning Diligence':
                                dd = ['Title commitment and policy', 'Zoning and Confirmation', 'ALTA/ACSM Survey', 'Final plans & specifications', 'Copies of easements, rights-of-way, and covenants affecting property', 'Notices of any violation of building codes, zoning or other ordinances', 'Estoppels from mortgagees, ground lessors & tenants', 'Certificates of occupancy & all other permits.', 'Subdivision Plat', 'Utility Report', 'Access Analysis', 'ADA Compliance Reports', 'Notices of any violation of building codes, zoning or other ordinances, laws or regulations affecting property.']
                                break;

                            default:
                        }
                        self.list.push({
                            id: folder.id,
                            name: folder.name,
                            edit: false,
                            type: folder.type,
                            data: [{
                                name: folder.name + ' DD List.dd',
                                edit: false,
                                list: dd
                            }]
                        });

                    })
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        copyFolder(id, destination) {
            axios.post(config.boxCopyFolder, {
                    id: id,
                    destination: destination
                })
                .then(function (resp) {
                    console.log(resp);
                    return;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        newDDList(name, parent) {
            this.loadingtxt = "Creating a new Sponsor Folder ..."
            // Create Diligence Folders for First timers
            var self = this
            axios.post(config.boxCreateFolder, {
                    name: name,
                    parent: parent
                })
                .then(function (resp) {
                    let data = {}
                    data.id = resp.data.response.id
                    data.name = resp.data.response.name
                    // Create new dd folders
                    self.createNewBoxFolder('Title Survey & Zoning Diligence', data.id)
                    self.createNewBoxFolder('Legal & Insurance Diligence', data.id)
                    self.createNewBoxFolder('Financial Diligence', data.id)
                    self.createNewBoxFolder('Debt Diligence', data.id)
                    self.createNewBoxFolder('Environmental & Property Condition', data.id)
                    self.createNewBoxFolder('Deal Documents', data.id)
                    self.createNewBoxFolder('Investor Documents', data.id)
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        updateList(val) {
            Cookies.remove(this.struc);
            Cookies.set(this.struc, val, {
                expires: 364
            })
        },
        companyRootList(val) {
            Cookies.remove('companyList');
            Cookies.set('companyList', val, {
                expires: 364
            })
        },
        loadFiles(val) {
            this.loadFile = val.load
            this.lft = val.txt
        },
        removeFile(key) {
            this.files.splice(key, 1);
        }
    },
};
</script>

<style>
.dragover {
    border: dashed 1px #999999 !important;
}

.upload-drag .ivu-modal-footer {
    display: none;
}

.dragArea li {
    /* list-style: none !important; */
    min-height: 30px !important;

}

.ivu-upload-drag:hover {
    border-color: #283f5c;
}

.full-width {
    width: 100%;
}
</style>
