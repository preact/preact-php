<?PHP
  Class LessNeglect {
    const api_project_code = '<your project code here>';
    const api_secret = '<your project secret here>';
    const api_url = 'https://lessneglect.com/api/v2/';
    const api_events_endpoint = 'events';
    const api_person_endpoint = 'people';

    /**
    * Posts data to the specified url endpoint
    * @param array $data The event or person data array
    * @param string $endPoint The LN API Endpoint
    * @return LN JSON Response
    */
    public static function post_message($data, $endPoint) {
      foreach($data as $key => $value) {
        $data_string .= $key.'='.HTML_Entity_Decode($value, ENT_QUOTES, 'UTF-8').'&';
      }
      rtrim($data_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, self::api_url.$endPoint;);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERPWD, self::api_project_code . ":" . self::api_secret);
      curl_setopt($ch, CURLOPT_POST, count($data));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      return curl_exec($ch );
    }

    /**
    * Calls the post_message function with the events endpoint
    * @param $data The array of event properties to post to LN
    */
    public static function log_event($data) {
      $result = self::post_message($data, self::api_events_endpoint);
    }

    /**
    * Calls the post_message function with the people endpoint
    * @param $data The array of people properties to post to LN
    */
    public static function update_person($data) {
      $result = self::post_message($data, self::api_person_endpoint);
    }

    /**
    * Calls the post_message function with the events endpoint with a specific message data array
    * @param $email The customer email address
    * @param $subject The message subject
    * @param $body The message body
    */
    public static function send_message($email = '', $subject = '', $body = '') {
      $data = Array(
        "person[email]" => ($email ? $email : User::$data[ 'email' ]),
        "event[subject]" => HTML_Entity_Decode($subject, ENT_QUOTES, 'UTF-8'),
        "event[body]" => HTML_Entity_Decode($body, ENT_QUOTES, 'UTF-8'),
        "event[klass]" => 'message'
      );
      $result = self::post_message($data, self::api_events_endpoint);
    }
  }
?>
