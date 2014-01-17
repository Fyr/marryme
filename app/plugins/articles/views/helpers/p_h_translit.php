<?
class PHTranslitHelper extends AppHelper {
	
	function convert($st, $lUrlMode = false) {
		// Ñíà÷àëà çàìåíÿåì "îäíîñèìâîëüíûå" ôîíåìû.
		$st = mb_convert_encoding($st, 'cp1251', 'utf8');
		$st = strtr($st, "àáâãäå¸çèéêëìíîïðñòóôõûý", "abvgdeeziyklmnoprstufhye");
		$st = strtr($st, "ÀÁÂÃÄÅ¨ÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÛÝ", "ABVGDEEZIYKLMNOPRSTUFHye");
		
		// Çàòåì - "ìíîãîñèìâîëüíûå".
		$st = strtr($st, array(
			"æ"=>"zh", "ö"=>"ts", "÷"=>"ch", "ø"=>"sh", "ù"=>"shch", "ü"=>"j", "ú"=>"j", "þ"=>"yu", "ÿ"=>"ya",
			"Æ"=>"ZH", "Ö"=>"TS", "×"=>"CH", "Ø"=>"SH", "Ù"=>"SHCH", "Ü"=>"J", "ú"=>"J", "Þ"=>"YU", "ß"=>"YA",
			"¿"=>"i", "¯"=>"Yi", "º"=>"ie", "ª"=>"Ye"
		));
		
		if ($lUrlMode) {
			$st = strtolower(str_replace(array("'", '"', ':', '!', '?', '(', ')', ',', '.'), '', $st));
			$st = str_replace(' ', '-', $st);
		}
		
		return $st;
	}
}
