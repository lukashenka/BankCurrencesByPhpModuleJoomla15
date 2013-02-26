<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<?php


$curs_table = "<table width=\"{$params->get('tableWidth')}\" class=\"curs_table\" cellspacing=0 cellpadding=0 border=0>";
$curs_table.='<tr class = "currenncesHeadTable"><td>Банк</td>';
$curs_table.='<td>USD пок.</td>';
$curs_table.='<td>USD прод.</td>';
$curs_table.='<td>EUR пок.</td>';
$curs_table.='<td>EUR прод.</td>';
$curs_table.='<td>RUВ пок.</td>';
$curs_table.='<td>RUВ прод.</td>';
$curs_table.='<td>EUR/USD</td>';
$curs_table.='<td>USD/EUR</td>';
$curs_table.='</tr>';
  $gray=false;   
foreach ($XML->children() as $bank) {
  
                                               //stepping
    $curs_table.='<tr class="bankslist';
     
    if($gray===true)
    {
        $curs_table.=' gray';
        $gray=false;
    }
    
    else
    {
        $gray=true;
    }
    
    $curs_table.='"><td><span class="bank_name">';


    if (stripos((string) $bank->bankname, "Трастбанк")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkTrustbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/trustbank.png\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "Паритетбанк")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkParitetbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/paritetbank.png\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "БЕЛРОСБАНК")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkBelrosbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/belrosbank.jpg\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "БПС-Сбербанк")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkBpsbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/bpsb.png\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "Идея Банк") || stripos((string) $bank->bankname, "Сомбелбанк")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkSombelbamk')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/ideabank.png\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "РРБ-Банк")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkRrbbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/rrb.jpg\">{$bank->bankname}</a>";
    } else if (stripos((string) $bank->bankname, "Банк БелВЭБ")) {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"{$params->get('linkBelvbank')}\"><img src = \"" . JURI::root() . "modules/mod_currencies/images/bveb.png\">{$bank->bankname}</a>";
    } else {
        $curs_table.="<span class=\"fulltext\"  onclick = \"showbankInformation(this)\"> + </span><a href = \"#\"><img src = \"unknown.png\">{$bank->bankname}</a></a>";
    }

    $curs_table.='</span><span class="bank_addr">Адресс: ' . $bank->bankaddress . '</span>';
    $curs_table.='<span class="bank_phone">Тел.' . $bank->bankphone . '</span>';
    $curs_table .= '</td>';
    $curs_table.='<td ' . ( ((float) $bank->usd_buy == $best['usd_buy']) ? ' class = "maximin"><strong>' . (string) $bank->usd_buy . '</strong>' : '>'.(string) $bank->usd_buy) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->usd_sell == $best['usd_sell']) ? ' class = "maximin"><strong>' . (string) $bank->usd_sell . '</strong>' : '>'.(string) $bank->usd_sell) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->eur_buy == $best['eur_buy']) ? ' class = "maximin"><strong>' . (string) $bank->eur_buy . '</strong>' : '>'.(string) $bank->eur_buy) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->eur_sell == $best['eur_sell']) ? ' class = "maximin"><strong>' . (string) $bank->eur_sell . '</strong>' : '>'.(string) $bank->eur_sell) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->rur_buy == $best['rur_buy']) ? ' class = "maximin"><strong>' . (string) $bank->rur_buy . '</strong>' : '>'.(string) $bank->rur_buy) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->rur_sell == $best['rur_sell']) ? ' class = "maximin"><strong>' . (string) $bank->rur_sell . '</strong>' : '>'.(string) $bank->rur_sell) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->eurusd_buy == $best['eurusd_buy']) ? ' class = "maximin"><strong>' . (string) $bank->eurusd_buy . '</strong>' : '>'.(string) $bank->eurusd_buy) . '</td>';
    $curs_table.='<td' . ( ((float) $bank->eurusd_sell == $best['eurusd_sell']) ? ' class ="maximin"><strong>' . (string) $bank->eurusd_sell . '</strong>' : '>'.(string) $bank->eurusd_sell) . '</td>';
    $curs_table.='</tr>';
}
$curs_table.='<tr class="bestCurrences"><td><strong>Лучший курс</strong></td>';
$curs_table.='<td><strong>' . $best['usd_buy'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['usd_sell'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['eur_buy'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['eur_sell'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['rur_buy'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['rur_sell'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['eurusd_buy'] . '</strong></td>';
$curs_table.='<td><strong>' . $best['eurusd_sell'] . '</strong></td>';
$curs_table.='</tr>';
$curs_table.='</table>';

echo $curs_table;



?>


