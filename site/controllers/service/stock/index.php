<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$item_per_page = 50;
$complete_list = FetchAllMaterials(1, 10000, $BASE->GetParam('s'), $BASE->GetParam('o'));
$total_items = count($complete_list);
$materials = FetchAllMaterials($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $BASE->GetParam('o'));
$materials->SetResultsTotal(MaterialsCount());
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'materials' => $materials,
	'total_items' => $total_items,
	'item_per_page' => $item_per_page,
	'search_default_value' => $BASE->GetParam('s'),
	'sort_id' => (int)($sort_code >> 1 & 0x3),
	'sort_type' => (int)$sort_code & 0x1
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>