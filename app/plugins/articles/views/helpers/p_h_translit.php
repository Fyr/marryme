<?
class PHTranslitHelper extends AppHelper {
	
	function convert($st, $lUrlMode = false) {
		// ������� �������� "��������������" ������.
		$st = mb_convert_encoding($st, 'cp1251', 'utf8');
		$st = strtr($st, "�����������������������", "abvgdeeziyklmnoprstufhye");
		$st = strtr($st, "�����Ũ�����������������", "ABVGDEEZIYKLMNOPRSTUFHye");
		
		// ����� - "���������������".
		$st = strtr($st, array(
			"�"=>"zh", "�"=>"ts", "�"=>"ch", "�"=>"sh", "�"=>"shch", "�"=>"j", "�"=>"j", "�"=>"yu", "�"=>"ya",
			"�"=>"ZH", "�"=>"TS", "�"=>"CH", "�"=>"SH", "�"=>"SHCH", "�"=>"J", "�"=>"J", "�"=>"YU", "�"=>"YA",
			"�"=>"i", "�"=>"Yi", "�"=>"ie", "�"=>"Ye"
		));
		
		if ($lUrlMode) {
			$st = strtolower(str_replace(array("'", '"', ':', '!', '?', '(', ')', ',', '.'), '', $st));
			$st = str_replace(' ', '-', $st);
		}
		
		return $st;
	}
}
