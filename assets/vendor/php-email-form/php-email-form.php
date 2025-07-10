<?php
class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $ajax = false;
  private $messages = [];

  public function add_message($content, $label = '', $length = 0) {
    if (strlen($content) >= $length) {
      $this->messages[] = "$label: $content";
    }
  }

  public function send() {
    if (!isset($this->to, $this->from_email, $this->subject)) {
      return "Missing required fields!";
    }

    $body = implode("\n", $this->messages);
    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    if (mail($this->to, $this->subject, $body, $headers)) {
      return "OK";
    } else {
      return "Email sending failed!";
    }
  }
}
?>
