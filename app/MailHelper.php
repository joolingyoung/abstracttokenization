<?php
    use Illuminate\Support\Facades\DB;
  function sendMail($fromAddress, $fromname, $toAddress, $subject, $data, $view) {

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom( $fromAddress, $fromname );
    $email->setSubject( $subject );
    if (is_array($toAddress)) {
      foreach($toAddress as $to) {
        $email->addTo($to);
      }
    } else {
      $email->addTo($toAddress);
    }
    $primary = DB::table('sites')->where('id', 1)->first();
    $contents = view($view, ['data' => $data, 'host' => "https://" . $primary->host])->render();
    $email->addContent( 'text/html', $contents );
    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    $sendgrid->send( $email );
  }
