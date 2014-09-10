<?PHP
  Class LessNeglect {
    const api_project_code = '<your project code here>';
    const api_secret = '<your project secret here>';
    const api_url = 'https://api.preact.io/api/v2/events';

    /**
    * Posts data to the specified url endpoint
    * @param array $data The event data array
    * @return LN JSON Response
    */
    public static function log_event($data) {
      $data_string = '';
      foreach($data as $key => $value) {
        $data_string .= $key.'='.HTML_Entity_Decode($value, ENT_QUOTES, 'UTF-8').'&';
      }
      rtrim($data_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, self::api_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERPWD, self::api_project_code . ":" . self::api_secret);
      curl_setopt($ch, CURLOPT_POST, count($data));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      return curl_exec($ch );
    }
  }
?>
