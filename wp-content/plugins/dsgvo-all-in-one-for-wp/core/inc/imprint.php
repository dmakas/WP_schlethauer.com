<?php

$imprint_template = "";
$imprint_template .= "<p>".__("Angaben gemäß § 5 TMG", "dsgvo-all-in-one-for-wp")."</p>";

$imprint_template .= "<p>";

if (get_option("dsgvoaiocompanyname", "") != "") {
	$imprint_template .= "[dsgvocompany]<br />";
}

$imprint_template .= "[dsgvoperson]<br/>";
$imprint_template .= "[dsgvostreet]<br/>";
$imprint_template .= "[dsgvozip] [dsgvocityowner]<br/>";
$imprint_template .= "[dsgvocountryowner]<br/>";

$imprint_template .= "</p>";
$imprint_template .= "<br />";
$imprint_template .= "<p><b>".__("Vertreten durch", "dsgvo-all-in-one-for-wp").":</b> [dsgvoperson]</p>";
$imprint_template .= "<br />";
$imprint_template .= "<p>";
$imprint_template .= "<b>".__("Kontakt", "dsgvo-all-in-one-for-wp").":</b><br/>";

if (get_option('dsgvoaiophone', '') != "") {
	$imprint_template .= __("Telefon", "dsgvo-all-in-one-for-wp").": [dsgvophone]<br/>";
}

if (get_option('dsgvoaiofax', '') != "") {
	$imprint_template .= __("Fax", "dsgvo-all-in-one-for-wp").": [dsgvofax]<br/>";
}

if (get_option('dsgvoaiomail', '') != "") {
	$imprint_template .= __("E-Mail", "dsgvo-all-in-one-for-wp").": [dsgvoemail]<br/>";
}

$imprint_template .= "</p>";


if (get_option("dsdvo_legalform_needregister", "no") == "yes") {
	$imprint_template .= "<br />";	
	$imprint_template .= "<p>";
	$imprint_template .= "<b>".__("Registereintrag", "dsgvo-all-in-one-for-wp").":</b><br/>";
	$imprint_template .= __("Registergericht", "dsgvo-all-in-one-for-wp").": [dsgvocity]<br/>";
	$imprint_template .= __("Registernummer", "dsgvo-all-in-one-for-wp").": [dsgvoregisternr]<br/>";
	$imprint_template .= "</p>";
}

if (get_option("dsdvo_legalform_ustid", "") != "") {
	$imprint_template .= "<br />";	
	$imprint_template .= "<p><b>".__("Umsatzsteuer-ID", "dsgvo-all-in-one-for-wp").":</b> [dsgvoustid]</p>";
}

if (get_option("dsdvo_legalform_wid", "") != "") {
$imprint_template .= "
<p><b>".__("Wirtschafts-ID", "dsgvo-all-in-one-for-wp").":</b> [dsgvowid]</p>";
}

if (get_option("dsdvo_legalform_needconsens", "no") == "yes") {
	$imprint_template .= "<br />";	
	$imprint_template .= "<p><b>".__("Aufsichtsbehörde", "dsgvo-all-in-one-for-wp").":</b> [dsgvosupervisoryauthority]</p>";
}

if (get_option("dsdvo_legalform_inforule", "1")["option_id"] != "1" && get_option("dsdvo_legalform_inforule", "1")["option_id"] != "0") {
	$imprint_template .= "<br />";
	$imprint_template .= "<p>";
	$imprint_template .= "<b>".__("Berufsbezeichnung", "dsgvo-all-in-one-for-wp").":</b> [dsgvoinforule]<br />";
	$imprint_template .= __("Zuständige Kammer", "dsgvo-all-in-one-for-wp").": [dsgvochamber]<br />";
	$imprint_template .= __("Verliehen durch den Staat", "dsgvo-all-in-one-for-wp").": [dsgvocountry]<br />";
	$imprint_template .= "</p>";
}

if (get_option("dsdvo_legalform_journalist", "no") == "yes") {
	$imprint_template .= "<br />";	
	$imprint_template .= "<p>";
	$imprint_template .= "<b>".__("Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV", "dsgvo-all-in-one-for-wp").":</b><br />";
	$imprint_template .= "[dsgvoperson_journalist]<br/>";
	$imprint_template .= "[dsgvostreet_journalist]<br/>";
	$imprint_template .= "[dsgvozip_journalist] [dsgvocity_journalist]<br/>";
	$imprint_template .= "[dsgvocountry_journalist]<br/>";
	$imprint_template .= "</p>";
}

if (get_option("dsdvo_clause", "no") == "yes") {
	$imprint_template .= "<br />";
	$imprint_template .= "<b>".__("Haftungsausschluss", "dsgvo-all-in-one-for-wp")."</b><br />";
	$imprint_template .= "<br />";	
	$imprint_template .= "<b>".__("Haftung für Links", "dsgvo-all-in-one-for-wp").":</b>";
	$imprint_template .= "<p>".__("Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.", "dsgvo-all-in-one-for-wp")."</p>";
	$imprint_template .= "<br />";	
	$imprint_template .= "<b>".__("Haftung für Inhalt", "dsgvo-all-in-one-for-wp").":</b>";
	$imprint_template .= "<p>".__("Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach § 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.", "dsgvo-all-in-one-for-wp")."</p>";

}


if (get_option("dsdvo_copyright", "no") == "yes") {
	$imprint_template .= "<br />";	
	$imprint_template .= "<b>".__("Urheberrecht", "dsgvo-all-in-one-for-wp")."</b><br />";
	$imprint_template .= "<p>".__("Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.", "dsgvo-all-in-one-for-wp")."</p>";

}

if (get_option("dsdvo_owntextsimprint", "no") == "yes") {
	$imprint_template .= "<br />";	
	if (!isset($language)) $language = wf_get_language();	
	
	if ($language == "de") {
		$imprint_template .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_customimprinttext"))));
	}
	
	if ($language == "en") {
		$imprint_template .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_customimprinttext_en"))));
	}	
}