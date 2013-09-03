<?php
include 'template.php';

$template = new Template();

$template->assign('my_var', 'test');

$template->assign('items', array(
      array('name' => 'First'),
      array('name' => 'Second')
));

$template->parse('tpl.html');
