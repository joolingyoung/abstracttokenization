@extends('emails.email-template')
@section('content')
<tr class="email-body">
    <td colspan='2'>
        <h2>Sponsor Bio</h2>
        <img src="{{$data['company-logo']}}" class='sponsor' alt='company-logo'>
        <br />Company Name: {{ isset($data['company_name']) ? $data['company_name'] : '' }}
        <br /> Company Website: {{ isset($data['company_website']) ? $data['company_website'] : '' }}
        <br /> First Name: {{ isset($data['first_name']) ? $data['first_name'] : '' }}
        <br /> Last Name: {{ isset($data['last_name']) ? $data['last_name'] : '' }}
        <br /> Work Phone: {{ isset($data['work_phone']) ? $data['work_phone'] : '' }}
        <br /> Company Address 1: {{ isset($data['company_address']) ? $data['company_address'] : '' }}
        <br /> Company Address 2: {{ isset($data['company_address_2']) ? $data['company_address_2'] : '' }}
        <br /> Mobile Phone: {{ isset($data['mobile']) ? $data['mobile'] : '' }}
        <br /> City: {{ isset($data['city']) ? $data['city'] : '' }}
        <br /> State: {{ isset($data['state']) ? $data['state'] : '' }}
        <br /> ZIP Code: {{ isset($data['zip']) ? $data['zip'] : '' }}
        <br /> Email: {{ isset($data['email']) ? $data['email'] : '' }}
        <br /> Job Title: {{ isset($data['job_title']) ? $data['job_title'] : '' }}
        <br /> Sponsor EIN/TIN: {{ isset($data['tin']) ? $data['tin'] : '' }}
        <br /> Country: {{ isset($data['company_wecountrybsite']) ? $data['country'] : '' }}
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Sponsor Bio</h2>
        <br /> <span>{{ isset($data['bio']) ? $data['bio'] : '' }}</span>
        <br /> Total Profile Activity Amount:
            <span>{{ isset($data['portfolio_activity_amount']) ? $data['portfolio_activity_amount'] : '' }}</span>
        <br /> Total Assets Under Management:
            <span>{{ isset($data['assets_under_management']) ? $data['assets_under_management'] : '' }}</span>
        <br /> Total Square Feet Managed:
            <span>{{ isset($data['square_feet_managed']) ? $data['square_feet_managed'] : '' }}</span>
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Meet the Principals, Property Owners or Fund Managers</h2>
        @if (isset( $data['principles'] ))
            @foreach ($data['principles'] as $index => $item)
                <div>
                    <img src="{{$data['principles-logos'][$index]}}" class='sponsor' alt='Company-Logo'>
                    <br /> <span>{{$item->bio}}</span>
                    <br /> Principal Full Name: <span>{{$item->name}}</span>
                    <br /> Principal Title: <span>{{$item->title}}</span>
                </div>
            @endforeach
        @endif
    </td>
</tr>
<tr class='email-body'>
    <td colspan='2'>
        <h2>Professional References</h2>
        <br /> Reference Type: {{ isset($data['reference_type_1']) ? $data['reference_type_1'] : '' }}
        <br /> First, Last Name: {{ isset($data['reference_name_1']) ? $data['reference_name_1'] : '' }}
        <br /> Phone Number: {{ isset($data['reference_phone_1']) ? $data['reference_phone_1'] : '' }}
        <br /> Email: {{ isset($data['reference_email_1']) ? $data['reference_email_1'] : '' }}
        <br />
        <br /> Reference Type: {{ isset($data['reference_type_2']) ? $data['reference_type_2'] : '' }}
        <br /> First, Last Name: {{ isset($data['reference_name_2']) ? $data['reference_name_2'] : '' }}
        <br /> Phone Number: {{ isset($data['reference_phone_2']) ? $data['reference_phone_2'] : '' }}
        <br /> Email: {{ isset($data['reference_email_2']) ? $data['reference_email_2'] : '' }}
        <br />
        <br /> Reference Type: {{ isset($data['reference_type_3']) ? $data['reference_type_3'] : '' }}
        <br /> First, Last Name: {{ isset($data['reference_name_3']) ? $data['reference_name_3'] : '' }}
        <br /> Phone Number: {{ isset($data['reference_phone_3']) ? $data['reference_phone_3'] : '' }}
        <br /> Email: {{ isset($data['reference_email_3']) ? $data['reference_email_3'] : '' }}
        <br />
        <br /> Reference Type: {{ isset($data['reference_type_4']) ? $data['reference_type_4'] : '' }}
        <br /> First, Last Name: {{ isset($data['reference_name_4']) ? $data['reference_name_4'] : '' }}
        <br /> Phone Number: {{ isset($data['reference_phone_4']) ? $data['reference_phone_4'] : '' }}
        <br /> Email: {{ isset($data['reference_email_4']) ? $data['reference_email_4'] : '' }}
    </td>
</tr>
<tr class="email-button">
    <td>
        <a href="{{$host}}/sponsor/approve?id=<?= $data['id']?>&token=<?= $data['approval_token']?>" style="min-width:180px;" class="button approve">Approve</a>
    </td>
    <td>
        <a href="{{$host}}/sponsor/reject?id=<?= $data['id']?>&token=<?= $data['approval_token']?>" class="button reject">Reject</a>
    </td>
</tr>
@endsection
