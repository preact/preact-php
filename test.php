<?php
include_once('LessNeglect.php');
$eventdata = Array(
  'person[name]' => 'gooley@lessneglect.com',
  'person[email]' => 'Christopher Gooley',
  'person[properties][is_paying]' => '1',
  'event[name]' => 'updated-profile',
  'event[klass]' => 'actionevent'
);
LessNeglect::log_event($eventdata);
echo "Updated Christopher Gooley's profile!";
?>
