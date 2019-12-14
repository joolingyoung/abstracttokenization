@extends('security-fund-flow.step-7.main-template')
@section('title', $title )

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Preview & Submit</h5>
    </div>
    <div class="card-content">
        <h5>You’re nearly there!</h5>
        <p>Hit preview to review all information to ensure it is correct. You may EDIT if need be by pressing the EDIT button at the start of each section; your information will automatically re-save when you hit submit at the bottom of the page.. You can change or edit your photos in the final Preview Screen</p>
        <div class="card">
            <div class="card-title dust has-button">
                <h5>Digital Security Details</h5>
                <a href="/security-fund-flow/step-1/upload-photos" class="btn color-white">Edit</a>
            </div>
            <div class="card-content">
                <file-preview
                    iname="Digital Security Photo Gallery"
                    scope="private"
                    user="{{Auth::id()}}"
                    field="fund-digital-security"
                    path="/digital-security/fund/photo-gallery/">
                </file-preview>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="content-footer">
                    <div class="footer-button-next">
                        <a href="/security-fund-flow/preview" class="btn color-white">Preview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection