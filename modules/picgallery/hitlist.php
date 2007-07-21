<?php

$dsp->NewContent(t('Bildergalerie'), t('Hitliste'));

echo '<ul class="Line">';
echo '<li class="LineLeftHalf">';

$templ['home']['show']['item']['info']['caption'] = t('Die letzten Änderungen');
$templ['home']['show']['item']['control']['row'] = '';
$res = $db->qry('SELECT name, UNIX_TIMESTAMP(changedate) AS changedate FROM %prefix%picgallery ORDER BY changedate DESC LIMIT 10');
while ($row = $db->fetch_array($res)) {
  $templ['home']['show']['row']['control']['link'] = 'index.php?mod=picgallery&action=show&step=2&file=/'. $row['name'] .'&page=0';
  $templ['home']['show']['row']['info']['text'] = $row['name'].' ['. $row['changedate'] .']';
  $templ['home']['show']['row']['info']['text2'] = '';
  $templ['home']['show']['item']['control']['row'] .= $dsp->FetchModTpl('home', 'show_row');
}
$db->free_result($row);
echo $dsp->FetchModTpl('home', 'show_item');

echo '</li>';
echo '<li class="LineRight">';

$templ['home']['show']['item']['info']['caption'] = t('Die meisten Hits');
$templ['home']['show']['item']['control']['row'] = '';
$res = $db->qry('SELECT name, clicks FROM %prefix%picgallery ORDER BY clicks DESC LIMIT 10');
while ($row = $db->fetch_array($res)) {
  $templ['home']['show']['row']['control']['link'] = 'index.php?mod=picgallery&action=show&step=2&file=/'. $row['name'] .'&page=0';
  $templ['home']['show']['row']['info']['text'] = $row['name'].' ['.$row['clicks'].']';
  $templ['home']['show']['row']['info']['text2'] = '';
  $templ['home']['show']['item']['control']['row'] .= $dsp->FetchModTpl('home', 'show_row');
}
$db->free_result($row);
echo $dsp->FetchModTpl('home', 'show_item');

echo '</li>';
echo '</ul>';
echo '<ul class="Line">';
echo '<li class="LineLeftHalf">';

$templ['home']['show']['item']['info']['caption'] = t('Die neusten Kommentare');
$templ['home']['show']['item']['control']['row'] = '';
$res = $db->qry('SELECT name, UNIX_TIMESTAMP(date) as date FROM %prefix%picgallery AS p
  LEFT JOIN %prefix%comments AS c ON p.picid = c.relatedto_id AND c.relatedto_item = \'Picgallery\'
  ORDER BY c.date DESC
  LIMIT 10');
while ($row = $db->fetch_array($res)) {
  $templ['home']['show']['row']['control']['link'] = 'index.php?mod=picgallery&action=show&step=2&file=/'. $row['name'] .'&page=0';
  $templ['home']['show']['row']['info']['text'] = $row['name'].' ['. $row['date'] .']';
  $templ['home']['show']['row']['info']['text2'] = '';
  $templ['home']['show']['item']['control']['row'] .= $dsp->FetchModTpl('home', 'show_row');
}
$db->free_result($row);
echo $dsp->FetchModTpl('home', 'show_item');

echo '</li>';
echo '<li class="LineRight">';

$templ['home']['show']['item']['info']['caption'] = t('Die meisten Kommentare');
$templ['home']['show']['item']['control']['row'] = '';
$res = $db->qry('SELECT name, COUNT(*) AS count FROM %prefix%picgallery AS p
  LEFT JOIN %prefix%comments AS c ON p.picid = c.relatedto_id AND c.relatedto_item = \'Picgallery\'
  GROUP BY c.relatedto_id
  ORDER BY count DESC
  LIMIT 10');
while ($row = $db->fetch_array($res)) {
  $templ['home']['show']['row']['control']['link'] = 'index.php?mod=picgallery&action=show&step=2&file=/'. $row['name'] .'&page=0';
  $templ['home']['show']['row']['info']['text'] = $row['name'].' ['.$row['count'].']';
  $templ['home']['show']['row']['info']['text2'] = '';
  $templ['home']['show']['item']['control']['row'] .= $dsp->FetchModTpl('home', 'show_row');
}
$db->free_result($row);
echo $dsp->FetchModTpl('home', 'show_item');

echo '</li>';
echo '</ul>';

?>