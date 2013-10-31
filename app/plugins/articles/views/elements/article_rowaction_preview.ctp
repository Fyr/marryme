<?
	if ($row['Article']['body'] && trim($row['Article']['body']) !== '<br />') {
		echo $this->element('icon_info', array('plugin' => 'core', 'title' => $row['Article']['body']));
	}
?>