<?php

defined('_JEXEC') or die('Restricted access');
if (version_compare(phpversion(), '5.1.0', '<') == true) {
    die('PHP5.1 Only');
}

class ModBankCurrences {

    
    

    public function MyMax($value, $best) {
        if (!empty($value)) {
            return max($value, $best);
        }
        return $best;
    }

    public function MyMin($value, $best) {
        if (!empty($value)) {
            if (empty($best)) {
                return $value;
            } else {
                return min($value, $best);
            }
        }
        return $best;
    }

    public function getXMLList() {
        $XML = new SimpleXMLElement(file_get_contents('http://myfin.by/scripts/xml/work/banks_city_20.xml'));
        if(!$XML)
            echo('error while parsing');
        return $XML;
    }

    public function getBestCurrences($XML) {
        if ($XML) {
            $best = array('usd_buy' => 0, 'usd_sell' => 0, 'eur_buy' => 0, 'eur_sell' => 0, 'rur_buy' => 0, 'eurusd_buy' => 0, 'eurusd_sell' => 0);
            foreach ( $XML->children() as $bank) {
                $best['usd_buy'] = $this->MyMax((float) $bank->usd_buy, $best['usd_buy']);
                $best['usd_sell'] = $this->MyMin((float) $bank->usd_sell, $best['usd_sell']);
                $best['eur_buy'] = $this->MyMax((float) $bank->eur_buy, $best['eur_buy']);
                $best['eur_sell'] = $this->MyMin((float) $bank->eur_sell, $best['eur_sell']);
                $best['rur_buy'] = $this->MyMax((float) $bank->rur_buy, $best['rur_buy']);
                $best['rur_sell'] = $this->MyMin((float) $bank->rur_sell, $best['rur_sell']);
                $best['eurusd_buy'] = $this->MyMax((float) $bank->eurusd_buy, $best['eurusd_buy']);
                $best['eurusd_sell'] = $this->MyMin((float) $bank->eurusd_sell, $best['eurusd_sell']);
            }
        }
        else
            echo 'data xml not loaded ';

        return $best;
    }

}
