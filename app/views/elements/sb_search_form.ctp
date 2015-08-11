<?
	$filtersBrands = array();
	if (isset($aFilters['data']['brand_id']) && $aFilters['data']['brand_id']) {
		$filtersBrands = (is_array($aFilters['data']['brand_id'])) ? $aFilters['data']['brand_id'] : array($aFilters['data']['brand_id']);
	}
	$title = (isset($aFilters['data']['title']) && $aFilters['data']['title']) ? $aFilters['data']['title'] : '';
	$price = (isset($aFilters['data']['price']) && $aFilters['data']['price']) ? $aFilters['data']['price'] : '';
	$price2 = (isset($aFilters['data']['price2']) && $aFilters['data']['price2']) ? $aFilters['data']['price2'] : '';
	$is_active_checked = (isset($aFilters['data']['is_active']) && $aFilters['data']['is_active']) ? 'checked="checked"' : '';

?>
					<?=$this->element('sb_title', array('title' => 'Поиск по каталогу'))?>
					<div class="item">
						<form class="search" action="/products/search/" method="get">
						<table class="pad5">
						<tr>
							<td class="w50">Название модели</td>
							<td>
								<input class="input" type="text" name="data[filter][title]" value="<?=$title?>" />
							</td>
						</tr>
						<tr>
							<td>Брэнд</td>
							<td>
<? /*
								<select name="data[filter][brand_id][]" size="6" multiple="multiple" autocomplete="off">
<?
	foreach($aSearch['Brands'] as $article) {
		$selected = (in_array($article['Article']['id'], $filtersBrands)) ? 'selected="selected"' : '';
?>
								<option value="<?=$article['Article']['id']?>" <?=$selected?>><?=$article['Article']['title']?></option>
<?
	}
?>
								</select>
<?
	*/
?>
								<div class="options">
<?
	foreach($aSearch['Brands'] as $catID => $brands) {
?>
									<div class="section"><?=$brands[0]['Category']['title']?></div>
<?
		foreach($brands as $article) {
			$checked = (in_array($article['Article']['id'], $filtersBrands)) ? 'checked="checked"' : '';
?>
									<input type="checkbox" name="data[filter][brand_id][]" value="<?=$article['Article']['id']?>" <?=$checked?> /><span><?=$article['Article']['title']?></span><br />

<?
		}
	}
?>
								</div>
							</td>
						</tr>
<?
	if (SHOW_PRICE) {
?>
						<tr>
							<td>Цена, $</td>
							<td>
								от <input class="price" type="text" name="data[filter][price]" value="<?=$price?>" />
								до <input class="price" type="text" name="data[filter][price2]" value="<?=$price2?>" /> <br/>
							</td>
						</tr>
<?
	}
	if (SHOW_SEARCH_ACTIVE) {
?>
						<tr>
							<td colspan="2">
								<input type="checkbox" name="data[filter][is_active]" value="1" <?=$is_active_checked?>/> <? __('Active');?>
							</td>
						</tr>
<?
	}
?>
						<tr>
							<td colspan="2" class="search_button">
								<input type="submit" name="go" value="Искать" />
							</td>
						</tr>
						</table>
						</form>
					</div>
