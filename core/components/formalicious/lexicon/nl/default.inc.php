<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$_lang['formalicious']                                          = 'Formalicious';
$_lang['formalicious.desc']                                     = 'De meest krachtige en eenvoudigste formulieren bouwer voor MODX.';

$_lang['area_formalicious']                                     = 'Formalicious';
$_lang['area_formalicious_editor']                              = 'Formalicious (rich text editor)';

$_lang['setting_formalicious.branding_url']                     = 'Branding';
$_lang['setting_formalicious.branding_url_desc']                = 'De URL waar de branding knop heen verwijst, indien leeg wordt de branding knop niet getoond.';
$_lang['setting_formalicious.branding_url_help']                = 'Branding (help)';
$_lang['setting_formalicious.branding_url_help_desc']           = 'De URL waar de branding help knop heen verwijst, indien leeg wordt de branding help knop niet getoond.';
$_lang['setting_formalicious.saveforms']                        = 'Formulieren opslaan';
$_lang['setting_formalicious.saveforms_desc']                   = 'Gebruikers kunnen aangeven of formulier opgeslagen mogen worden in FormIt.';
$_lang['setting_formalicious.saveforms_prefix']                 = 'Formulieren opslaan prefix';
$_lang['setting_formalicious.saveforms_prefix_desc']            = 'Indien formulier opgeslagen kunnen worden in FormIt wordt de naam geprefixt met deze prefix.';
$_lang['setting_formalicious.disallowed_hooks']                 = 'Niet toegestane hooks';
$_lang['setting_formalicious.disallowed_hooks_desc']            = 'De niet toegestane FormIt snippet call hooks. Meerdere hooks scheiden met een komma, standaard is "spam,email,redirect".';
$_lang['setting_formalicious.preview_css']                      = 'Formulier voorvertoning CSS';
$_lang['setting_formalicious.preview_css_desc']                 = 'De URL van het CSS bestand die ingeladen wordt voor de voorvertoning van een formulier.';
$_lang['setting_formalicious.use_editor']                       = 'Gebruik richt text editor';
$_lang['setting_formalicious.use_editor_desc']                  = 'Gebruik een rich text editor voor de chatbot.';
$_lang['setting_formalicious.editor_plugins']                    = 'Plugins';
$_lang['setting_formalicious.editor_plugins_desc']              = 'De \'plugins\' config voor de rich text editor.';
$_lang['setting_formalicious.editor_toolbar1']                  = 'Toolbar 1';
$_lang['setting_formalicious.editor_toolbar1_desc']             = 'De \'toolbar1\' config voor de rich text editor.';
$_lang['setting_formalicious.editor_toolbar2']                  = 'Toolbar 2';
$_lang['setting_formalicious.editor_toolbar2_desc']             = 'De \'toolbar2\' config voor de rich text editor.';
$_lang['setting_formalicious.editor_toolbar3']                  = 'Toolbar 3';
$_lang['setting_formalicious.editor_toolbar3_desc']             = 'De \'toolbar3\' config voor de rich text editor.';
$_lang['setting_formalicious.editor_menubar']                   = 'Menubar';
$_lang['setting_formalicious.editor_menubar_desc']              = 'De \'menubar\' config voor de rich text editor.';
$_lang['setting_formalicious.editor_statusbar']                 = 'Statusbar';
$_lang['setting_formalicious.editor_statusbar_desc']            = 'De \'statusbar\' config voor de rich text editor.';

$_lang['formalicious.category']                                 = 'Categorie';
$_lang['formalicious.categories']                               = 'Categorieën';
$_lang['formalicious.categories.desc']                          = 'Het ordenen van je formulieren is een aangeraden, dat kan doormiddel van het aanmaken van categorieën hier onder. Deze categorieën zullen beschikbaar zijn als tabs in het formulierenoverzicht.';
$_lang['formalicious.categories.create']                        = 'Nieuwe categorie';
$_lang['formalicious.categories.update']                        = 'Categorie bewerken';
$_lang['formalicious.categories.remove']                        = 'Categorie verwijderen';
$_lang['formalicious.categories.remove_confirm']                = 'Weet je zeker dat je deze categorie wilt verwijderen?';

$_lang['formalicious.categories.label_name']                    = 'Naam';
$_lang['formalicious.categories.label_name_desc']               = '';
$_lang['formalicious.categories.label_description']             = 'Omschrijving';
$_lang['formalicious.categories.label_description_desc']        = '';
$_lang['formalicious.categories.label_published']               = 'Gepubliceerd';
$_lang['formalicious.categories.label_published_desc']          = '';

$_lang['formalicious.fieldtype']                                = 'Veldtype';
$_lang['formalicious.fieldtypes']                               = 'Veldtypes';
$_lang['formalicious.fieldtypes.desc']                          = 'Een formulier bestaand uit velden, deze velden kunnen bijvoorbeeld bestaan uit het type text of email. Formalicious bestaat standaard uit meerdere veldtypes die nodig zijn om een krachtig en eenvouding formulier te maken. Hieronder kan je eigen velden aanmaken.';
$_lang['formalicious.fieldtypes.create']                        = 'Nieuwe veldtype';
$_lang['formalicious.fieldtypes.update']                        = 'Veldtype bewerken';
$_lang['formalicious.fieldtypes.remove']                        = 'Veldtype verwijderen';
$_lang['formalicious.fieldtypes.remove_confirm']                = 'Weet je zeker dat je dit veldtype wil verwijderen? Dit verwijdert ook alle velden die gekoppeld zijn aan dit veldtype.';
$_lang['formalicious.fieldtypes.duplicate']                     = 'Veldtype dupliceren';

$_lang['formalicious.fieldtypes.label_name']                    = 'Naam';
$_lang['formalicious.fieldtypes.label_name_desc']               = '';
$_lang['formalicious.fieldtypes.label_tpl']                     = 'Chunk';
$_lang['formalicious.fieldtypes.label_tpl_desc']                = 'De naam van de chunk die als template voor dit veldtype gebruikt wordt.';
$_lang['formalicious.fieldtypes.label_fields']                  = 'Velden';
$_lang['formalicious.fieldtypes.label_fields_desc']             = '';
$_lang['formalicious.fieldtypes.label_values']                  = 'Waarden';
$_lang['formalicious.fieldtypes.label_values_desc']             = 'Dit veldtype kan waarden bevatten.';
$_lang['formalicious.fieldtypes.label_answertpl']               = 'Waarden chunk';
$_lang['formalicious.fieldtypes.label_answertpl_desc']          = 'De naam van de chunk die als template voor de waarden van dit veldtype gebruikt wordt. Waardes zijn verplicht voor selectboxes, checkboxes en radio buttons.';
$_lang['formalicious.fieldtypes.label_validation']              = 'Validatie';
$_lang['formalicious.fieldtypes.label_validation_desc']         = 'Kommagescheiden lijst van FormIt validators voor dit veldtype. Kijk bij built-in validators op https://docs.modx.com/extras/revo/formit/formit.validators.';
$_lang['formalicious.fieldtypes.label_icon']                    = 'Icoon';
$_lang['formalicious.fieldtypes.label_icon_desc']               = 'Bij het toevoegen van een veld aan een formulier wordt dit icoon getoond bij het kiezen van een veldtype.';

$_lang['formalicious.form']                                     = 'Formulier';
$_lang['formalicious.forms']                                    = 'Formulieren';
$_lang['formalicious.forms.create']                             = 'Nieuw formulier';
$_lang['formalicious.forms.update']                             = 'Formulier bewerken';
$_lang['formalicious.forms.remove']                             = 'Formulier verwijderen';
$_lang['formalicious.forms.remove_confirm']                     = 'Weet je zeker dat je dit formulier wilt verwijderen? Dit verwijdert ook alle onderliggende stappen en velden.';
$_lang['formalicious.forms.duplicate']                          = 'Formulier dupliceren';

$_lang['formalicious.settings']                                 = 'Instellingen';
$_lang['formalicious.settings.desc']                            = 'Hier kan je de formulier instellingen instellen. Hier is het o.a. mogelijk om een \'bedankt pagina\' aan het formulier te koppelen waar de bezoekers op terecht zal komen nadat die het formulier ingevuld heeft.';

$_lang['formalicious.settings.email.desc']                      = 'Hier kan je de e-mail instellen die verstuurd wordt zodra de bezoeker het formulier invult, om een e-mail te kunnen versturen dien je de onderstaande instellingen in te stellen.';
$_lang['formalicious.settings.fair.desc']                       = 'Hier kan je de auto-reply e-mail instellen die naar de bezoeker verstuurd wordt zodra hij of zij het formulier invuld, om een auto-reply te kunnen versturen dien je de onderstaande instellingen in te stellen.';

$_lang['formalicious.settings.label_name']                      = 'Naam';
$_lang['formalicious.settings.label_name_desc']                 = 'De naam van het formulier, deze naam wordt alleen binnen de MODX Manager gebruikt.';
$_lang['formalicious.settings.label_email']                     = 'E-mail';
$_lang['formalicious.settings.label_email_desc']                = 'Indien aangevinkt zal er een e-mail verstuurd worden zodra de bezoeker het formulier invult.';
$_lang['formalicious.settings.label_emailto']                   = 'E-mail ontvanger';
$_lang['formalicious.settings.label_emailto_desc']              = 'Indien gevuld zal het formulier naar dit e-mailadres gestuurd worden. Vul bij meerdere adressen dit kommagescheiden in, bijvoorbeeld \'info@domein.com,admin@domein.com\'.';
$_lang['formalicious.settings.label_emailsubject']              = 'E-mail onderwerp';
$_lang['formalicious.settings.label_emailsubject_desc']         = 'Het onderwerp van de e-mail die verstuurd wordt als een formulier ingevuld wordt. Bijvoorbeeld \'Er is een contactformulier ingevuld\'.';
$_lang['formalicious.settings.label_emailcontent']              = 'E-mail introtekst';
$_lang['formalicious.settings.label_emailcontent_desc']         = 'De introtekst van de e-mail die verstuurd wordt als een formulier ingevuld wordt. Bijvoorbeeld \'Er is een contactformulier ingevuld binnen de website. Binnen 2 - 3 dagen dient er een antwoord gestuurd te worden\'.';
$_lang['formalicious.settings.label_redirectto']                = 'Bedankt pagina';
$_lang['formalicious.settings.label_redirectto_desc']           = 'Zodra de bezoeker het formulier ingevuld heeft wordt hij of zij doorgestuurd naar deze pagina, indien leeg dan blijft de bezoeker op dezelfde pagina. Zorg er altijd voor dat de bedankt pagina niet gevonden kan worden binnen Google en de website door dit uit te schakelen in de SEO Tab van de de pagina.';
$_lang['formalicious.settings.label_saveform']                  = 'Ingevulde formulieren opslaan';
$_lang['formalicious.settings.label_saveform_desc']             = 'Indien aangevinkt zullen alle ingevulde formulieren opgeslagen worden. De formulieren worden opgeslagen in de FormIt extra.';
$_lang['formalicious.settings.label_published']                 = 'Gepubliceerd';
$_lang['formalicious.settings.label_published_desc']            = 'Indien aangevinkt zal het formulier beschikbaar zijn op de website.';
$_lang['formalicious.settings.label_published_from']            = 'Publicatie datum';
$_lang['formalicious.settings.label_published_from_desc']       = 'Indien een publicatie datum ingesteld wordt, dan zal het formulier zichtbaar worden zodra deze datum bereikt is.';
$_lang['formalicious.settings.label_published_till']            = 'De-publicatie datum';
$_lang['formalicious.settings.label_published_till_desc']       = 'Indien een de-publicatie datum ingesteld wordt, dan zal de formulier publicatie ongemaakt worden zodra deze datum bereikt is.';
$_lang['formalicious.settings.label_fiaremail']                 = 'Auto-reply e-mail';
$_lang['formalicious.settings.label_fiaremail_desc']            = 'Indien aangevinkt zal er een auto-reply e-mail verstuurd worden zodra de bezoeker het formulier invult.';
$_lang['formalicious.settings.label_fiaremailto']               = 'Auto-reply e-mail veld';
$_lang['formalicious.settings.label_fiaremailto_desc']          = 'Selecteer het e-mail veld waar de auto-reply e-mail naartoe gestuurd moet worden. Als er geen velden getoond worden, voeg dan eerst velden toe aan het formulier via het tabblad \'Formulier velden\'.';
$_lang['formalicious.settings.label_fiaremailfrom']             = 'Auto-reply e-mail afzender';
$_lang['formalicious.settings.label_fiaremailfrom_desc']        = 'Het e-mailadres waarmee de auto-reply e-mail verstuurd wordt, dit e-mailadres ziet de bezoeker als afzender in zijn/haar mailbox. Bijvoorbeeld \'info@domein.com\'.';
$_lang['formalicious.settings.label_fiaremailsubject']          = 'Auto-reply e-mail onderwerp';
$_lang['formalicious.settings.label_fiaremailsubject_desc']     = 'Het onderwerp waarmee de auto-reply e-mail verstuurd wordt. Bijvoorbeeld \'Bedankt voor je interesse\'.';
$_lang['formalicious.settings.label_fiaremailcontent']          = 'Auto-reply e-email introtekst';
$_lang['formalicious.settings.label_fiaremailcontent_desc']     = 'De introtekst van de auto-reply e-email die verstuurd wordt. Bijvoorbeeld \'Hallo! Bedankt voor het invullen van ons contactformulier. Binnen 2 - 3 dagen kun je een reactie van ons verwachten. Met vriendelijke groet\'.';
$_lang['formalicious.settings.label_fiaremailattachment']       = 'Auto-reply e-mail bijlage';
$_lang['formalicious.settings.label_fiaremailattachment_desc']  = 'Het bestand die als bijlage met de auto-reply e-email die verstuurd wordt. Het bestand dient een maximale bestandsgrootte te hebben van 8 MB (afhankelijk van de server instellingen).';

$_lang['formalicious.step']                                     = 'Veld';
$_lang['formalicious.steps']                                    = 'Velden';
$_lang['formalicious.steps.desc']                               = 'Hier kan je de formulier velden instellen, De stappen boven de velden kunnen worden hernoemd door op de stap-tekst te dubbelklikken. Je kunt de stappen ordenen door ze in de gewenste volgorde te slepen.';
$_lang['formalicious.step.create']                              = 'Nieuwe stap';
$_lang['formalicious.step.update']                              = 'Stap bewerken';
$_lang['formalicious.step.remove']                              = 'Stap verwijderen';
$_lang['formalicious.step.remove_confirm']                      = 'Weet je zeker dat je deze stap wil verwijderen? Dit verwijdert ook alle onderliggende velden.';
$_lang['formalicious.step.preview']                             = 'Stap voorvertoning';

$_lang['formalicious.step.label_title']                         = 'Titel';
$_lang['formalicious.step.label_title_desc']                    = 'De titel van de stap.';
$_lang['formalicious.step.label_button']                        = 'Knop titel';
$_lang['formalicious.step.label_button_desc']                   = 'De titel van de submit of volgende knop, indien leeg dan wordt standaard "Verzenden" or "Volgende" gebruikt.';

$_lang['formalicious.field.create']                             = 'Veld toevoegen';
$_lang['formalicious.field.update']                             = 'Veld bewerken';
$_lang['formalicious.field.remove']                             = 'Veld verwijderen';
$_lang['formalicious.field.remove_confirm']                     = 'Weet je zeker dat je dit veld wilt verwijderen?';
$_lang['formalicious.field.duplicate']                          = 'Veld dupliceren';

$_lang['formalicious.field.label_type']                         = 'Type';
$_lang['formalicious.field.label_type_desc']                    = 'De type van het veld.';
$_lang['formalicious.field.label_title']                        = 'Label';
$_lang['formalicious.field.label_title_desc']                   = 'De label van het veld, deze wordt naast het veld getoond.';
$_lang['formalicious.field.label_description']                  = 'Omschrijving';
$_lang['formalicious.field.label_description_desc']             = 'De begeleidende omschrijving, deze wordt onder of boven het veld getoond.';
$_lang['formalicious.field.label_placeholder']                  = 'Placeholder';
$_lang['formalicious.field.label_placeholder_desc']             = 'De tijdelijke tekst, deze wordt getoond in het veld en legt een gebruiker uit wat in het veld moet worden ingevuld. Voorbeeld placeholder: Vul hier uw naam in.';
$_lang['formalicious.field.label_property']                     = 'Heading grootte';
$_lang['formalicious.field.label_property_desc']                = 'De lettertype grootte van de heading.';
$_lang['formalicious.field.label_published']                    = 'Gepubliceerd';
$_lang['formalicious.field.label_published_desc']               = '';
$_lang['formalicious.field.label_required']                     = 'Verplicht';
$_lang['formalicious.field.label_required_desc']                = '';

$_lang['formalicious.field.value']                              = 'Waarde';
$_lang['formalicious.field.values']                             = 'Waardes';
$_lang['formalicious.field.value.create']                       = 'Nieuwe waarde';
$_lang['formalicious.field.value.update']                       = 'Waarde bewerken';
$_lang['formalicious.field.value.remove']                       = 'Waarde verwijderen';
$_lang['formalicious.field.value.remove_confirm']               = 'Weet je zeker dat je deze wilt verwijderen?';

$_lang['formalicious.field.value.label_name']                   = 'Naam';
$_lang['formalicious.field.value.label_name_desc']              = '';
$_lang['formalicious.field.value.label_published']              = 'Gepubliceerd';
$_lang['formalicious.field.value.label_published_desc']         = '';
$_lang['formalicious.field.value.label_selected']               = 'Geselecteerd';
$_lang['formalicious.field.value.label_selected_desc']          = '';

$_lang['formalicious.advanced']                                 = 'Geavanceerde instellingen';
$_lang['formalicious.advanced.desc']                            = 'Geavanceerde formulier instellingen.';

$_lang['formalicious.advanced.label_prehooks']                  = 'Prehooks';
$_lang['formalicious.advanced.label_prehooks_desc']             = 'Komma gescheiden lijst van FormIt prehooks die uitgevoerd worden zodra het formulier ingeladen wordt.';
$_lang['formalicious.advanced.label_posthooks']                 = 'Posthooks';
$_lang['formalicious.advanced.label_posthooks_desc']            = 'Komma gescheiden lijst van FormIt posthooks die uitgevoerd worden zodra het formulier verzonden is. Deze hooks worden alleen uitgevoerd na succesvolle validatie.';

$_lang['formalicious.advanced.parameters']                      = 'Parameters';
$_lang['formalicious.advanced.parameters.desc']                 = 'Hier kun je custom FormIt parameters toevoegen. Deze parameters worden toegevoegd aan de FormIt snippet call, bijvoorbeeld \'&formTpl=`customFormTpl`\'.';
$_lang['formalicious.advanced.parameters.create']               = 'Parameter toevoegen';
$_lang['formalicious.advanced.parameters.update']               = 'Parameter bewerken';
$_lang['formalicious.advanced.parameters.remove']               = 'Parameter verwijderen';
$_lang['formalicious.advanced.parameters.remove_confirm']       = 'Weet je zeker dat je deze parameter wilt verwijderen?';

$_lang['formalicious.advanced.parameters.label_key']            = 'Parameter key';
$_lang['formalicious.advanced.parameters.label_key_desc']       = '';
$_lang['formalicious.advanced.parameters.label_value']          = 'Parameter waarde';
$_lang['formalicious.advanced.parameters.label_value_desc']     = '';

$_lang['formalicious.default_view']                             = 'Standaard weergave';
$_lang['formalicious.admin_view']                               = 'Admin weergave';
$_lang['formalicious.back_to_forms']                            = 'Terug naar formulieren';
$_lang['formalicious.active_step']                              = 'Active stap';
$_lang['formalicious.new_step']                                 = 'Nieuwe stap';
$_lang['formalicious.no_forms']                                 = 'Voeg eerst enkele categoriën toe. Klik daarom op "Admin weergave" en voeg sowieso één categorie toe.';
$_lang['formalicious.form_err_ae']                              = 'Een formulier met dezelfde naam bestaat al, specificeer een andere naam.';
$_lang['formalicious.form_err_posthooks']                       = 'De spam, email and redirect hooks worden automatisch toegevoegd aan de FormIt snippet call door Formalicious. Het is niet nodig om ze hier te specificeren.';
$_lang['formalicious.form_not_exists']                          = 'Form met het ID "[[+id]]" is niet gevonden.';
$_lang['formalicious.formit_view_form']                         = 'Bekijk in FormIt';

$_lang['formalicious.submit']                                   = 'Verzenden';
$_lang['formalicious.next']                                     = 'Volgende';
$_lang['formalicious.prev']                                     = 'Vorige';

$_lang['formalicious.contentblocks_input']                      = 'Formalicious formulier';
$_lang['formalicious.contentblocks_input.description']          = 'Kies een Formalicious formulier om in te voegen in de content.';
