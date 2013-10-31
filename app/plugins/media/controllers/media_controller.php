<?
class MediaController extends MediaAppController {
	var $name = 'Media';

	var $uses = array('media.Media');

	function submit() {
		$backUrl = $this->data['backUrl'];
		$this->Media->save($this->data);

		$this->Media->initMain($this->data['Media']['object_type'], $this->data['Media']['object_id']);

		if (!isset($this->data['Media']['media_type']) || $this->data['Media']['media_type'] == 'image') {
			$this->Media->recalcStats($this->data['Media']['object_type'], $this->data['Media']['object_id']);
		}

		$this->redirect($backUrl);
	}
}
