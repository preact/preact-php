preact-php
===============

Preact client logging library for PHP

##Example usage##
    <?php
    include_once('Preact.php');
    $eventdata = Array(
      'person[name]' => 'gooley@lessneglect.com',
      'person[email]' => 'Christopher Gooley',
      'person[uid]' => '12345',
      'person[created_at]' => '1358108502.033349',
      'event[name]' => 'viewed:item',
      'event[target_id]' => '54321',
      'event[note]' => 'Item Name'
    );
    LessNeglect::log_event($eventdata);
    ?>

License
--
Copyright (c) 2012-2014 Preact, Inc. See LICENSE.md for further details.