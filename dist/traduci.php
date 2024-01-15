<?php 

require_once 'vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

// Contenuto originale in italiano
$descrizione = $row['descrizione'];
$tipo_immobile = $row['tipo_immobile'];
$comune = $row['comune'];
$tipo_vendita= $row['tipo_vendita'];
$cucina = $row['cucina'];
$soggiorno = $row['soggiorno'];
$riscaldamento =$row['riscaldamento'];
$condizioni = $row['condizioni'];

// Crea un'istanza di GoogleTranslate
$translator = new GoogleTranslate();

// Imposta la lingua di origine e la lingua di destinazione
$translator->setSource('it');
$translator->setTarget('en');

// Traduci la descrizione in inglese
$descrizioneInglese = $translator->translate($descrizione);
$tipo_immobileInglese = $translator->translate($tipo_immobile);
$comuneInglese = $translator->translate($comune);
$tipo_venditaInglese = $translator->translate($tipo_vendita);
$cucinaInglese = $translator->translate($cucina);
$soggiornoInglese = $translator->translate($soggiorno);
$riscaldamentoInglese= $translator->translate($riscaldamento);
$condizioniInglese = $translator->translate($condizioni);
// Stampa la descrizione tradotta

?>