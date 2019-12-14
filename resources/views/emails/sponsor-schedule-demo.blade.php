@extends('emails.email-template')
@section('content')
<tr class="email-body">
    <td colspan='2'>
        <span>{{ isset($data['sponsor_name']) ? $data['sponsor_name'] : '' }} has requested a demo.</span>
    </td>
</tr>
@endsection
