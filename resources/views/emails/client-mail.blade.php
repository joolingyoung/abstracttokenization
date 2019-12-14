@extends('emails.email-template')
@section('content')
<tr class="email-body">
    <td>
        {{$data['comments']}}
        <a href="{{$data['link_url']}}"> {{$data['link_str']}}</a>
    </td>
</tr>
<tr class="footer">
    <td >
        Join our conversation
    </td>
</tr>
<tr class="footer">
    <td>
        <a href="https://www.facebook.com/AbstractTokenization" target="_blank"><img src="http://develop.abstracttokenization.com/img/logo-facebook.png" alt="Facebook"></a>
        <a href="https://twitter.com/abstractToken" target="_blank"><img src="http://develop.abstracttokenization.com/img/logo-twitter.png" alt="Twitter"></a>
        <a href="https://www.instagram.com/abstracttokenization/" target="_blank"><img src="http://develop.abstracttokenization.com/img/logo-instagram.png" alt="instagram"></a>
    </td>
</tr>
<tr class="footer">
    <td>
        © Abstract Tokenization 2019 </p><a href="http://develop.abstracttokenization.com/img/AbstractPrivacyPolicy.pdf"
            target="_blank">Privacy Policy</a>
    </td>
</tr>
@endsection
