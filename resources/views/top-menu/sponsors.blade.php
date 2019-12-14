
<div class="dashboard-menu-tile-container">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <a class="color-white" href="/account-settings/verification">
                <div class="dashboard-menu-tile {{ $select == 'account-settings' ? 'active' : '' }}">
                    <img src="/img/icon-user-setting{{$select == 'account-settings' ? '-active' : '' }}.svg">
                    @if ($site->id == 1)
                        <h5>Account Settings and Sponsor Diligence</h5>
                    @else
                        <h5>Account Settings</h5>
                    @endif
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <a href="/investor-servicing/choose-investment">
                <div class="dashboard-menu-tile {{ $select == 'investor-servicing' ? 'active' : '' }}">
                    <img src="/img/icon-paper-settings{{$select == 'investor-servicing' ? '-active' : '' }}.svg">
                    <h5>Investor Servicing</h5>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <a href="/security-flow/step-1/choose">
                <div class="dashboard-menu-tile {{ $select == 'create-digital-security' ? 'active' : '' }}">
                    <img src="/img/icon-secured{{ $select == 'create-digital-security' ? '-active' : '' }}.svg">
                    <h5>Create Digital Security</h5></a>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <a class="color-white" href="/properties/approved">
                <div class="dashboard-menu-tile {{ $select == 'my-properties' ? 'active' : '' }}">
                    <img src="/img/icon-building.svg">
                    <h5>My Digital Securities</h5></a>
                </div>
            </a>
        </div>
    </div>
</div>
