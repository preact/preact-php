lessneglect-php
===============

Less Neglect client logging library for PHP

##Example usage##
    <?php
    include_once('LessNeglect.php');
    $eventdata = Array(
      'person[name]' => 'gooley@lessneglect.com',
      'person[email]' => 'Christopher Gooley',
      'person[external_identifier]' => '12345',
      'person[properties][created_at]' => '1358108502.033349',
      'event[name]' => 'viewed:item',
      'event[klass]' => 'actionevent',
      'event[external_identifier]' => '54321',
      'event[note]' => 'Item Name'
    );
    LessNeglect::log_event($eventdata);
    ?>
