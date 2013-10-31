<?
class PriceHelper extends AppHelper {
	function format($descr = '', $price) {
		$output = '';
		if ($price > 0) {
			$output = $descr.'<span class="price">'.PU_.number_format($price * BYR_COURSE)._PU.'</span>'.' <span class="alt-price">($'.number_format($price).')</span>';
		}
		return $output;
	}
}
