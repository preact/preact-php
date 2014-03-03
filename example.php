<?php
    include_once('Preact.php');

    $api_config = array(
        'project_code' => 'PROJECT_CODE',
        'api_secret' => 'API_SECRET'
    );

    $preact = new Preact($api_config);

    $person = array(
        'email' => 'gooley@preact.com',
        'name'  => 'Christopher Gooley',
        'properties' => array(
            'is_paying' => true
        )
    );

    $event = array(
        'name' => 'updated-profile'
    );

    $eventdata = array(
        'event' => $event,
        'person' => $person
    );

    $resp = $preact->log_event($eventdata);
