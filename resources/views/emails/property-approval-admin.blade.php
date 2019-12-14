@extends('emails.email-template')
@section('content')
<tr class="email-body">
    <td colspan='2'>
        <h2>Presented By</h2>
        <img src="{{$data['company-logo']}}" class='sponsor' alt='company-logo'>
        <br />{{ isset($data['prisented_by']) ? $data['prisented_by'] : '' }}
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Property Details</h2>
        @if (isset( $data['property-images'] ))
            @foreach ($data['property-images'] as $item)
                <img src="{{$item['src']}}" class='sponsor' alt='Company-Logo'>
            @endforeach
        @endif
        <br />Property / Opportunity Name: {{ isset($data['property']) ? $data['property'] : '' }}
        <br />Opportunity Type: {{ isset($data['opportunity_type']) ? $data['opportunity_type'] : 'null' }}
        <br />Short Description of Opportunity: {{ isset($data['opportunity_description']) ? $data['opportunity_description'] : 'null' }}
        <br />Property Address: {{ isset($data['property_address']) ? $data['property_address'] : 'null' }}
        <br />City: {{ isset($data['city']) ? $data['city'] : '' }}
        <br />State: {{ isset($data['state']) ? $data['state'] : '' }}
        <br />Zip Code: {{ isset($data['zip']) ? $data['zip'] : '' }}
        <br />Country: {{ isset($data['country']) ? $data['country'] : '' }}
        <br />Vacancy Rate: {{ isset($data['vacancy_rate']) ? $data['vacancy_rate'] : '' }}
        <br />Current NOI: {{ isset($data['current_noi']) ? $data['current_noi'] : '' }}
        <br />Annual Cash Flow: {{ isset($data['annual_cash_flow']) ? $data['annual_cash_flow'] : '' }}
        <br />1031 Exchange: {{ isset($data['1031_exchange']) ? $data['1031_exchange'] : '' }}
        <br />Market Value: {{ isset($data['market_value']) ? $data['market_value'] : '' }}
        <br />Square Footage: {{ isset($data['square_footage']) ? $data['square_footage'] : '' }}
        <br />Property Class: {{ isset($data['property_class']) ? $data['property_class'] : '' }}
        <br />Total Debt: {{ isset($data['total_debt']) ? $data['total_debt'] : '' }}
        <br />Payoff Date: {{ isset($data['payoff_date']) ? $data['payoff_date'] : '' }}
        <br />Amortizing:
            <?php
                if (isset($data['loan-type']) && $data['loan-type'] === 'Amortizing') {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?>
        <br />Interest Only:
            <?php
                if (isset($data['loan-type']) && $data['loan-type'] === 'Interest Only') {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?>
        <br />Is the Property Developed?
            <?php
                if (isset($data['developed']) && $data['developed'] === 'yes') {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?>
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Deal Highlights</h2>
        <br />Target Investor IRR: {{ isset($data['target-investor-irr']) ? $data['target-investor-irr'] : 'null' }}
        <br />Investment Profile: {{ isset($data['investment-profile']) ? $data['investment-profile'] : 'null' }}
        <br />Funds Due: {{ isset($data['funds-due']) ? $data['funds-due'] : 'null' }}
        <br />Target Equity Multiple: {{ isset($data['target-equity-multiple']) ? $data['target-equity-multiple'] : 'null' }}
        <br />Minimum Investment: {{ isset($data['minimum-investment']) ? $data['minimum-investment'] : 'null' }}
        <br />Distribution Period: {{ isset($data['distribution-period']) ? $data['distribution-period'] : 'null' }}
        <br />Target Investment Period: {{ isset($data['target-investment-period']) ? $data['target-investment-period'] : '' }}
        <br />Property Type: {{ isset($data['property-type']) ? $data['property-type'] : 'null' }}
        <br />Sponsor Co-Investment: {{ isset($data['sponsor-co-investment']) ? $data['sponsor-co-investment'] : 'null' }}
        <br />Target Avg Investor Cash Yield: {{ isset($data['target-avg-investor-cash-yield']) ? $data['target-avg-investor-cash-yield'] : 'null' }}
        <br />Offers Due: {{ isset($data['offers-due']) ? $data['offers-due'] : 'null' }}
        <br />Distribution Commencement: {{ isset($data['distribution-commencement']) ? $data['distribution-commencement'] : 'null' }}
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Investment Details</h2>
        @if (isset( $data['cap_table_link'] ))
            <a href="{{$data['cap_table_link']}}" download>{{$data['cap_table_name']}}</a>
        @endif
        <br />Pro forma NOI: {{ isset($data['pro-frorma-noi']) ? $data['pro-frorma-noi'] : '' }}
        <br />Distribution frequency: {{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : 'null' }}
        <br />Equity Raise Floor Amount: {{ isset($data['equity-raise-floor-amount']) ? $data['equity-raise-floor-amount'] : '' }}
        <br />Total Capital Required: {{ isset($data['total-capital-required']) ? $data['total-capital-required'] : '' }}
        <br />Equity Raise Hard Cap: {{ isset($data['equity-raise-hard-cap']) ? $data['equity-raise-hard-cap'] : '' }}
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Capital Stack</h2>
        <br />Preferred Equity: {{ isset($data['preferred-equity']) ? $data['preferred-equity'] : '' }}%
        <br />Common Equity: {{ isset($data['common-equity']) ? $data['common-equity'] : '' }}%
        <br />Mezzanine Debt: {{ isset($data['mezzanine-debt']) ? $data['mezzanine-debt'] : '' }}%
        <br />Senior Debt: {{ isset($data['senior-debt']) ? $data['senior-debt'] : '' }}%
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Key Deal Points</h2>
        <br /><span><?= $data['key-points'] ?></span>
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Meet the Principals</h2>
        @if (isset( $data['principles'] ))
            @foreach ($data['principles'] as $index => $item)
                <div>
                    <img src="{{$data['principles-logos'][$index]}}" class='sponsor' alt='Company-Logo'>
                    <br /> This is the text of the principal bio.
                    <br /> <span>{{$item->bio}}</span>
                    <br /> Principal Full Name: <span>{{$item->name}}</span>
                    <br /> Principal Title: <span>{{$item->title}}</span>
                </div>
            @endforeach
        @endif
    </td>
</tr>
<tr class="email-button">
    <td>
        <a href="{{$host}}/property/approve?id=<?= $data['id']?>&token=<?= $data['approval_token']?>" style="min-width:180px;" class="button approve">Approve</a>
    </td>
    <td>
        <a href="{{$host}}/property/reject?id=<?= $data['id']?>&token=<?= $data['approval_token']?>" class="button reject">Reject</a>
    </td>
</tr>
@endsection
