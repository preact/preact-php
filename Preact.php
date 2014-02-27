<?php

    Class Preact
    {
        private $project_code;
        private $api_secret;
        const API_URL = 'https://api.preact.io/api/v2/events';

        /**
        * Create a Preact object use in logging events.
        * @param array $api_config An array containing the Project Code and API Secret
        */
        public function __construct(array $api_config)
        {
            if (!in_array('curl', get_loaded_extensions())) {
                throw new Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');
            }
            
            if (!isset($api_config['project_code']) || !isset($api_config['api_secret'])) {
                throw new Exception('The constructor is expecting an array containing the project code and api secret.');
            }

            $this->project_code = $api_config['project_code'];
            $this->api_secret = $api_config['api_secret'];
        }

        /**
         * Validate the event data
         * @param  array   $event_data The event data array
         * @return boolean             true if the event data valid, false otherwise
         */
        private function validate_event_data($event_data) {
            // No event data was sent to log
            if (!isset($event_data)) {
                return false;
            }

            // Required person data was not set
            if (!isset($event_data['person'])
                || !isset($event_data['person']['email'])) {
                return false;
            }

            // Required event data was not set
            if (!isset($event_data['event'])
                || !isset($event_data['event']['name'])) {
                return false;
            }

            return true;
        }

        /**
        * Posts data to the specified url endpoint
        * @param array $event_data The event data array
        * @return Preact JSON Response
        */
        public function log_event($event_data) {

            // invalid event data
            if (!$this->validate_event_data($event_data)) {
                return false;
            }

            $post_data = json_encode($event_data);

            // There was an error encoding the JSON
            if (!$post_data) {
                return false;
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_USERPWD, $this->project_code . ":" . $this->api_secret);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            return curl_exec($ch);
        }
    }
