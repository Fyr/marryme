<?
	//$this->PHCore->css('/categories/categories.css');

	$id = $this->PHA->read($aArticle, 'Article.id');
	$page_id = $this->PHA->read($aArticle, 'Article.page_id');
	$seo_block = $this->element('admin_edit', array('plugin' => 'seo', 'data' => $aArticle, 'object_type' => 'Article'));
?>
<h2><?=$pageTitle?></h2>
<?
	if ($id) {
?>
<div align="right" style="width: 550px">
<?
		if ($objectType == 'pages') {
?>
	<a href="<?=$this->Router->url($aArticle)?>" target="_blank" title="<? __('View this page on site in a new tab');?>"><? __('View page');?></a>
<?
		} else {
?>
	<a href="<?=$this->Router->url($aArticle)?>" target="_blank" title="<? __('View this article on site in a new tab');?>"><? __('View article');?></a>
<?
		}
?>
</div>
<?
	}
?>
<div class="errMsg"><?=$errMsg?></div>
<?
/*
	if ($objectType == 'brands') {
		echo $this->element('category_widget', array('plugin' => 'category', 'title' => __('Category', true), 'canEdit' => false, 'empty' => false, 'selected' => $this->PHA->read($aArticle, 'Article.object_id')));
	} elseif ($objectType == 'photos') {
		echo $this->element('category_widget', array('plugin' => 'category', 'title' => __('Photoalbum', true), 'selected' => $this->PHA->read($aArticle, 'Article.object_id')));
	}
*/
	/*
		if ($objectType == 'collections') {
		echo $this->element('category_widget', array('plugin' => 'category', 'canEdit' => false, 'empty' => false, 'selected' => $this->PHA->read($aArticle, 'Article.object_id'), 'title' => __('Brand', true)));
	}
*/
?>
<!--div class="accessoriesTD" style="position: absolute; top: 150px; display: none;">
<?//$this->element('category_widget', array('plugin' => 'category', 'title' => __('Subcategory', true), 'aCategoryOptions' => $aSubcategoryOptions, 'selected' => $this->PHA->read($aArticle, 'Article.subcategory_id')));?>
</div-->
<form id="articleForm" name="articleForm" action="" method="post">
<input type="hidden" id="catObj" name="data[Article][object_type]" value="<?=$objectType?>" />
<input type="hidden" id="catID" name="data[Article][subcategory_id]" value="<?=$this->PHA->read($aArticle, 'Article.subcategory_id')?>" />
<?
	if ($objectType == 'brands') {
?>
		<? __('Category');?>
		<select class="autocompleteOff" name="data[Article][object_id]">
		<?=$this->element('category_options', array('plugin' => 'category', 'aCategoryOptions' => $aCategoryOptions, 'selected' => $this->PHA->read($aArticle, 'Article.object_id'), 'empty' => false))?>
		</select>
<?
	} elseif ($objectType == 'collections') {
?>
	<? __('Brand');?>
	<select class="autocompleteOff" name="data[Article][object_id]">
<?
		foreach($aBrandCategories as $categoryID => $aIDs) {
?>
		<optgroup label="<?=$aCategoryOptions[$categoryID]?>">
<?
			foreach($aIDs as $_id) {
?>
			<option value="<?=$_id?>"<?=($this->PHA->read($aArticle, 'Article.object_id') == $_id) ? ' selected="selected"' : ''?>><?=$aBrandOptions[$_id]?></option>
<?
			}
?>
		</optgroup>
<?
		}
?>
	</select>
<?
	} elseif ($objectType == 'products') {
		$currCollection = $this->PHA->read($aArticle, 'Article.object_id');
?>
<script type="text/javascript">
<?
	if ($productCategoryID) {
		if ($productCategoryID == 20) {
?>
$(document).ready(function(){
	editProduct_onChangeCategory();
});
<?
		} else {
?>
$(document).ready(function(){
	editProduct_onChangeCategory();
	$('#brandSelect').val(<?=$productBrandID?>);
	editProduct_onChangeBrand();
	$('#collectionSelect').val(<?=$this->PHA->read($aArticle, 'Article.object_id')?>)
});
<?
		}
	}
?>
function editProduct_onChangeCategory() {
	$('#brandSelect optgroup').hide();
	$('#category' + $('#categorySelect').val()).show();

	if ($('#categorySelect').val() == 20) {
		$('.brandTD').hide();
		$('.collectionTD').hide();
		$('.accessoriesTD').show();
	} else {
		$('.brandTD').show();
		$('.collectionTD').show();
		$('.accessoriesTD').hide();

		brandID = $('option:first', '#category' + $('#categorySelect').val()).attr('value');
		$('#brandSelect').val(brandID);

		editProduct_onChangeBrand();
	}
}

function editProduct_onChangeBrand() {
	$('#collectionSelect optgroup').hide();
	$('#brand' + $('#brandSelect').val()).show();

	collectionID = $('option:first', '#brand' + $('#brandSelect').val()).attr('value');
	if (collectionID) {
		$('#collectionSelect').val(collectionID);
		$('#collectionSelect').show();
	} else {
		$('#collectionSelect').hide();
		alert('По данному брэнду нет ни одной коллекции!');
	}

}

</script>
	<table class="pad5" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="15%">
			<? __('Category');?>
		</td>
		<td>
			<select class="autocompleteOff" id="categorySelect" name="data[Article][category_id]" onchange="editProduct_onChangeCategory()">
			<?=$this->element('category_options', array('plugin' => 'category', 'aCategoryOptions' => $aCategoryOptions, 'selected' => $productCategoryID, 'empty' => false))?>
			</select>
		</td>
	</tr>
	<tr class="accessoriesTD" style="display: none;">
		<td>
			<? __('Subcategory');?>
		</td>
		<td>
			<select class="autocompleteOff" id="subcategorySelect" name="data[Article][subcategory_id]" onchange="editProduct_onChangeCategory()">
			<?=$this->element('category_options', array('plugin' => 'category', 'aCategoryOptions' => $aSubcategoryOptions, 'selected' => $this->PHA->read($aArticle, 'Article.subcategory_id'), 'empty' => false))?>
			</select>
		</td>
	</tr>
	<tr class="brandTD">
		<td>
			<? __('Brand');?>
		</td>
		<td>
	<select class="autocompleteOff" id="brandSelect" name="data[Article][brand_id]" onchange="editProduct_onChangeBrand()">
<?
		foreach($aBrandCategories as $categoryID => $aIDs) {
?>
		<optgroup id="category<?=$categoryID?>" label="<?=$aCategoryOptions[$categoryID]?>">
<?
			foreach($aIDs as $_id) {
?>
			<option value="<?=$_id?>"<?=($productBrandID == $_id) ? ' selected="selected"' : ''?>><?=$aBrandOptions[$_id]?></option>
<?
			}
?>
		</optgroup>
<?
		}
?>
	</select>
		</td>
	</tr>
	<tr class="collectionTD">
		<td>
			<? __('Collection');?>
		</td>
		<td>
	 <select class="autocompleteOff" id="collectionSelect" name="data[Article][object_id]">
<?
		foreach($aBrandCollections as $categoryID => $aIDs) {
?>
		<optgroup id="brand<?=$categoryID?>" label="<?=$aBrandOptions[$categoryID]?>">
<?
			foreach($aIDs as $_id) {
?>
			<option value="<?=$_id?>"<?=($this->PHA->read($aArticle, 'Article.object_id') == $_id) ? ' selected="selected"' : ''?>><?=$aCollectionOptions[$_id]?></option>
<?
			}
?>
		</optgroup>
<?
		}
?>
	</select>
		</td>
	</tr>
	</table>
<?
	}
	if ($id) {
		if ($objectType == 'articles') {
			$tags_block = $this->element('admin_edit', array('plugin' => 'tags', 'aTags' => $aTags, 'object_type' => 'Article', 'object_id' => $id, 'aRelatedTags' => $aRelatedTags));
			echo $this->element('wgt_exp_block', array('plugin' => 'core', 'id' => 'tags', 'caption' => 'Tags', 'content' => $tags_block));
		}
		if ($objectType != 'pages') {
			// echo $this->element('wgt_exp_block', array('plugin' => 'core', 'id' => 'tags', 'caption' => 'Tags', 'content' => $tags_block));
		}
	}
	echo $this->element('wgt_exp_block', array('plugin' => 'core', 'id' => 'seo', 'caption' => 'SEO', 'content' => $seo_block));
	echo '<br />';
	if ($objectType == 'pages') {
		echo $this->element('admin_edit_page');
	} elseif ($objectType == 'products') {
		echo $this->element('admin_edit_product');
	} else {
		echo $this->element('admin_edit', array('plugin' => 'articles', 'showPageID' => (in_array($objectType, array('articles', 'news', 'brands', 'collections')))));
	}
?>
</form>
<?
	if ($id) {
?>
<form id="mediaForm" name="mediaForm" action="/media/media/submit/" method="post" enctype="multipart/form-data">
<input type="hidden" name="data[Media][inputName]" value="files" />
<input type="hidden" name="data[Media][object_type]" value="Article" />
<input type="hidden" name="data[Media][object_id]" value="<?=$this->PHA->read($aArticle, 'Article.id')?>" />
<input type="hidden" name="data[Media][makeThumb]" value="1" />
<?
	$backUrl = '/admin/articlesEdit/'.$id;
?>
<input type="hidden" name="data[backUrl]" value="<?=$backUrl?>" />
<br />
<?=$this->element('media_edit', array('plugin' => 'media', 'aMedia' => $aArticle['Media']))?>
</form>
<?
	}
?>