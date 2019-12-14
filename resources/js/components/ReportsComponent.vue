<template>
<div class="row middle-xs">
    <div class="col-xs-12 col-md-6 text-center margin-bottom-m-md">
        <div class="row center-xs">
            <div class="col-xs-12 col-md-8">
                <uploads
                    type="single"
                    action="/files"
                    elname="image"
                    scope="private"
                    title="Upload organizations K-1"
                    path="/investo-servicing/report/k-1/">
                </uploads>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-left">
                        <p class="mgn-t">K-1 Year:</p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                        <DatePicker type="year" placeholder="Select year"></DatePicker>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="row center-xs">
            <div class="col-xs-12 col-md-8">
                <p class="no-margin-top">You can choose a date at least 2 days after you upload your quarterly report. Abstract will email this defined quarterly report to ALL posiitions tied to the deal.</p>
                <DatePicker type="date" :options="startDate" placeholder="Select Date"></DatePicker>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import uploads from './UploadsComponent';
export default {
    components: {
        uploads
    },
    data () {
      return {
        startDate: {
			disabledDate(date) {
				return date && date.valueOf() < Date.now() + 86400000 * 2;
			}
		}
      }
    }
}
</script>
<style scoped>
    .mgn-t{
        margin-top: 15px;
    }
</style>
