<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$_lang['formalicious']                                          = 'Formalicious';
$_lang['formalicious.desc']                                     = 'Der mächtigste und einfachste Formulargenerator für MODX.';

$_lang['area_formalicious']                                     = 'Formalicious';
$_lang['area_formalicious_editor']                              = 'Formalicious (rich text editor)';

$_lang['setting_formalicious.branding_url']                     = 'Branding';
$_lang['setting_formalicious.branding_url_desc']                = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
$_lang['setting_formalicious.branding_url_help']                = 'Branding (help)';
$_lang['setting_formalicious.branding_url_help_desc']           = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
$_lang['setting_formalicious.saveforms']                        = 'Save forms';
$_lang['setting_formalicious.saveforms_desc']                   = 'Users are allowed to save forms in FormIt.';
$_lang['setting_formalicious.saveforms_prefix']                 = 'Save forms prefix';
$_lang['setting_formalicious.saveforms_prefix_desc']            = 'When users are allowd to save Forms in FormIt the name will be prefixed with this prefix.';
$_lang['setting_formalicious.disallowed_hooks']                 = 'Not allowed hooks';
$_lang['setting_formalicious.disallowed_hooks_desc']            = 'The not allowed FormIt snippet call hooks. Separate multiple hooks with a comma, default is "spam,email,redirect".';
$_lang['setting_formalicious.preview_css']                      = 'Form preview CSS';
$_lang['setting_formalicious.preview_css_desc']                 = 'The URL of the CSS file thay will be loaded for the preview of a form.';
$_lang['setting_formalicious.use_editor']                       = 'Use rich text editor';
$_lang['setting_formalicious.use_editor_desc']                  = 'Use a rich text editor for the chatbot.';
$_lang['setting_formalicious.editor_plugins']                   = 'Plugins';
$_lang['setting_formalicious.editor_plugins_desc']              = 'The \'plugins\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar1']                  = 'Toolbar 1';
$_lang['setting_formalicious.editor_toolbar1_desc']             = 'The \'toolbar1\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar2']                  = 'Toolbar 2';
$_lang['setting_formalicious.editor_toolbar2_desc']             = 'The \'toolbar2\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar3']                  = 'Toolbar 3';
$_lang['setting_formalicious.editor_toolbar3_desc']             = 'The \'toolbar3\' config for the rich text editor.';
$_lang['setting_formalicious.editor_menubar']                   = 'Menubar';
$_lang['setting_formalicious.editor_menubar_desc']              = 'The \'menubar\' config for the rich text editor.';
$_lang['setting_formalicious.editor_statusbar']                 = 'Statusbar';
$_lang['setting_formalicious.editor_statusbar_desc']            = 'The \'statusbar\' config for the rich text editor.';

$_lang['formalicious.category']                                 = 'Kategorie';
$_lang['formalicious.categories']                               = 'Kategorien';
$_lang['formalicious.categories.desc']                          = 'Bringe Ordnung in Deine Formulare. Erstelle Kategorien. Diese erscheinen als Tabs in der Formularübersicht.';
$_lang['formalicious.categories.create']                        = 'Kategorie erstellen';
$_lang['formalicious.categories.update']                        = 'Kategorie bearbeiten';
$_lang['formalicious.categories.remove']                        = 'Kategorie entfernen';
$_lang['formalicious.categories.remove_confirm']                = 'Willst Du diesen Kategorie wirklich entfernen?';

$_lang['formalicious.categories.label_name']                    = 'Name';
$_lang['formalicious.categories.label_name_desc']               = '';
$_lang['formalicious.categories.label_description']             = 'Beschreibung';
$_lang['formalicious.categories.label_description_desc']        = '';
$_lang['formalicious.categories.label_published']               = 'Veröffentlicht';
$_lang['formalicious.categories.label_published_desc']          = '';

$_lang['formalicious.fieldtype']                                = 'Feldtyp';
$_lang['formalicious.fieldtypes']                               = 'Feldtypen';
$_lang['formalicious.fieldtypes.desc']                          = 'Ein Formular besteht aus Feldern. Diese Felder können als Typen kategorisiert werden, z.B. text oder email. Formalicious wird mit allen nötigen Feldtypen ausgeliefert, die es für ein voll funktionstüchtiges Formular zu erstellen. Es können aber auch eigene Feldtypen erstellt werden.';
$_lang['formalicious.fieldtypes.create']                        = 'Feldtyp erstellen';
$_lang['formalicious.fieldtypes.update']                        = 'Feldtyp bearbeiten';
$_lang['formalicious.fieldtypes.remove']                        = 'Feldtyp entfernen';
$_lang['formalicious.fieldtypes.remove_confirm']                = 'Willst Du diesen Feldtyp wirklich entfernen?';
$_lang['formalicious.fieldtypes.duplicate']                     = 'Feldtyp duplizieren';

$_lang['formalicious.fieldtypes.label_name']                    = 'Name';
$_lang['formalicious.fieldtypes.label_name_desc']               = '';
$_lang['formalicious.fieldtypes.label_tpl']                     = 'Chunk';
$_lang['formalicious.fieldtypes.label_tpl_desc']                = 'Name des Chunks, der als Template für dieses Feld benutzt wird.';
$_lang['formalicious.fieldtypes.label_fields']                  = 'Felder';
$_lang['formalicious.fieldtypes.label_fields_desc']             = '';
$_lang['formalicious.fieldtypes.label_values']                  = 'Werte';
$_lang['formalicious.fieldtypes.label_values_desc']             = 'Dieser Feldtyp kann Werte enthalten';
$_lang['formalicious.fieldtypes.label_answertpl']               = 'Chunk für Feldwerte';
$_lang['formalicious.fieldtypes.label_answertpl_desc']          = 'Name des Chunks als Template für die Werte eines Feldes. Feldwerte sind zwingend für Selectboxes, Checkboxes und Radio Buttons.';
$_lang['formalicious.fieldtypes.label_validation']              = 'Prüfroutinen (Validators)';
$_lang['formalicious.fieldtypes.label_validation_desc']         = 'Kommaseparierte Liste von FormIt Prüfungen (Validators), die für dieses Feld eingesetzt werden. Schau unter https://docs.modx.com/extras/revo/formit/formit.validators für bereits eingebaute Prüfroutinen.';
$_lang['formalicious.fieldtypes.label_icon']                    = 'Icon';
$_lang['formalicious.fieldtypes.label_icon_desc']               = 'Dieses Icon wird angezeigt, wenn ein Feld dieses Typs dem Formular hinzugefügt wird.';

$_lang['formalicious.form']                                     = 'Formular';
$_lang['formalicious.forms']                                    = 'Formulars';
$_lang['formalicious.forms.create']                             = 'Formular erstellen';
$_lang['formalicious.forms.update']                             = 'Formular bearbeiten';
$_lang['formalicious.forms.remove']                             = 'Formular entfernen';
$_lang['formalicious.forms.remove_confirm']                     = 'Willst Du dieses Formular wirklich entfernen?';
$_lang['formalicious.forms.duplicate']                          = 'Formular duplizieren';

$_lang['formalicious.settings']                                 = 'Instellungen';
$_lang['formalicious.settings.desc']                            = 'Here you can manage the form settings. Here you can set up a \'thank you page\' where the visitor will send to after he fills in the form.';

$_lang['formalicious.settings.email.desc']                      = 'Here you can manage the email that will be sent when a visitor completes the form, to send an email you need to set up the following settings.';
$_lang['formalicious.settings.fair.desc']                       = 'Here you can manage the auto-reply email that will be sent to the visitor when he completes the form, to send an auto-reply email you need to set up the following settings.';

$_lang['formalicious.settings.label_name']                      = 'Name';
$_lang['formalicious.settings.label_name_desc']                 = 'This is the name of the form, this name is only visible within Formalicious and is for your own overview.';
$_lang['formalicious.settings.label_email']                     = 'Email';
$_lang['formalicious.settings.label_email_desc']                = 'When filled an email will be sent after the visitor completes the form.';
$_lang['formalicious.settings.label_emailto']                   = 'Email receiver';
$_lang['formalicious.settings.label_emailto_desc']              = 'When filled the form will be sent to this emailaddress. For multiple addresses, enter those comma separately, for example: info@companyname.com,admin@companyname.com.';
$_lang['formalicious.settings.label_emailsubject']              = 'Email Betreff';
$_lang['formalicious.settings.label_emailsubject_desc']         = 'This is the subject of the e-mail that will be sent when a visitor completes the form. For example: A contact form has been filled in.';
$_lang['formalicious.settings.label_emailcontent']              = 'Email einführungstext';
$_lang['formalicious.settings.label_emailcontent_desc']         = 'This is the introtext of the e-mail that will be sent when a visitor completes the form. For example A contact form has been filled in within the website. An answer must be sent within 2 - 3 days.';
$_lang['formalicious.settings.label_redirectto']                = 'Weiterleiten zu';
$_lang['formalicious.settings.label_redirectto_desc']           = 'When filled the visitor will be redirected to this resource when he fills in a form. You can create this page within the tree structure on the left side. Always make sure that the resource can not be found within Google and the website by disabling this in the SEO tab of the resource.';
$_lang['formalicious.settings.label_saveform']                  = 'Übermitteltes Formular speichern';
$_lang['formalicious.settings.label_saveform_desc']             = 'When filled all the completed forms to be saved? The forms are then stored within FormIt tha can be found under the \'components\' menu.';
$_lang['formalicious.settings.label_published']                 = 'Veröffentlicht';
$_lang['formalicious.settings.label_published_desc']            = 'When filled the form will be available.';
$_lang['formalicious.settings.label_published_from']            = 'Publication date';
$_lang['formalicious.settings.label_published_from_desc']       = 'When a publication date is filled the form will be available when this date is reached.';
$_lang['formalicious.settings.label_published_till']            = 'Un-publication date';
$_lang['formalicious.settings.label_published_till_desc']       = 'When an un-publication date is filled the form publication will be undone when this date is reached.';
$_lang['formalicious.settings.label_fiaremail']                 = 'Automatische Antwort schicken';
$_lang['formalicious.settings.label_fiaremail_desc']            = 'When filled an auto reply email will be sent to the visitor after he completes the form.';
$_lang['formalicious.settings.label_fiaremailto']               = 'Automatische Antwort Email Feld';
$_lang['formalicious.settings.label_fiaremailto_desc']          = 'Select the email field where the auto-reply email should be sent. If no fields are available, first add fields to the form via the tab \'Form fields\'.';
$_lang['formalicious.settings.label_fiaremailfrom']             = 'utomatische Antwort Email von';
$_lang['formalicious.settings.label_fiaremailfrom_desc']        = 'Enter the email address of the auto-reply email. For example, info@companyname.com. The visitor sees this as the sender in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailsubject']          = 'Automatische Antwort Email Betreff';
$_lang['formalicious.settings.label_fiaremailsubject_desc']     = 'This is the subject of the auto-reply email. This is the subject the visitor sees when they receive this e-mail in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailcontent']          = 'Automatische Antwort Email Einführungstext';
$_lang['formalicious.settings.label_fiaremailcontent_desc']     = 'This is the introtext of the auto-reply email. For example: Hello! Thank you for filling in our contact form. Within 2 - 3 days you can expect a response from us. With kind regards, company name X.';
$_lang['formalicious.settings.label_fiaremailattachment']       = 'Automatische Antwort Email Befestigung';
$_lang['formalicious.settings.label_fiaremailattachment_desc']  = 'Select a file that will be sent as an attachment for the auto-reply email. This file is limited to the following file types: pdf, doc, docx, png, jpg, gif. The file must have a maximum file size of 8 MB.';

$_lang['formalicious.step']                                     = 'Field';
$_lang['formalicious.steps']                                    = 'Fields';
$_lang['formalicious.steps.desc']                               = 'Manage the form fields. A step can be renamed by double-clicking the text. You can rearrange the steps by dragging the tabs into the desired order.';
$_lang['formalicious.step.create']                              = 'Schritt erstellen';
$_lang['formalicious.step.update']                              = 'Schritt bearbeiten';
$_lang['formalicious.step.remove']                              = 'Schritt entfernen';
$_lang['formalicious.step.remove_confirm']                      = 'Willst Du diesen Schritt wirklich entfernen? Dadurch werden auch alle untergeordneten Felder entfernt.';
$_lang['formalicious.step.preview']                             = 'Schritt Vorschau';

$_lang['formalicious.step.label_title']                         = 'Titel';
$_lang['formalicious.step.label_title_desc']                    = 'Der Titel des Schritts.';
$_lang['formalicious.step.label_button']                        = 'Schaltflächentitel';
$_lang['formalicious.step.label_button_desc']                   = 'Wenn der Titel der Schaltfläche Senden oder Weiter leer ist, wird standardmäßig "Senden" oder "Weiter" verwendet.';

$_lang['formalicious.field.create']                             = 'Feld erstellen';
$_lang['formalicious.field.update']                             = 'Feld bearbeiten';
$_lang['formalicious.field.remove']                             = 'Feld entfernen';
$_lang['formalicious.field.remove_confirm']                     = 'Willst Du dieses Feld wirklich entfernen?';
$_lang['formalicious.field.duplicate']                          = 'Feld duplizieren';

$_lang['formalicious.field.label_type']                         = 'Type';
$_lang['formalicious.field.label_type_desc']                    = '';
$_lang['formalicious.field.label_title']                        = 'Title';
$_lang['formalicious.field.label_title_desc']                   = '';
$_lang['formalicious.field.label_description']                  = 'Beschreibung';
$_lang['formalicious.field.label_description_desc']             = 'Die begleitende Beschreibung, die unter oder über dem Feld angezeigt wird.';
$_lang['formalicious.field.label_placeholder']                  = 'Platzhalter';
$_lang['formalicious.field.label_placeholder_desc']             = 'Text der im im Feld selber angezeigt wird, damit der Benutzer weiss, was er einzufüllen hat. Beispiel Platzhalter: Bitte füllen Sie Ihren Namen ein.';
$_lang['formalicious.field.label_property']                     = 'Überschrift Größe';
$_lang['formalicious.field.label_property_desc']                = 'Die Schriftgröße der Überschrift.';
$_lang['formalicious.field.label_published']                    = 'Veröffentlicht';
$_lang['formalicious.field.label_published_desc']               = '';
$_lang['formalicious.field.label_required']                     = 'Zwingend';
$_lang['formalicious.field.label_required_desc']                = '';

$_lang['formalicious.field.value']                              = 'Wert';
$_lang['formalicious.field.values']                             = 'Werten';
$_lang['formalicious.field.value.create']                       = 'Wert erstellen';
$_lang['formalicious.field.value.update']                       = 'Wert bearbeiten';
$_lang['formalicious.field.value.remove']                       = 'Wert entfernen';
$_lang['formalicious.field.value.remove_confirm']               = 'Willst Du dieses Wert wirklich entfernen?';

$_lang['formalicious.field.value.label_name']                   = 'Name';
$_lang['formalicious.field.value.label_name_desc']              = '';
$_lang['formalicious.field.value.label_published']              = 'Veröffentlicht';
$_lang['formalicious.field.value.label_published_desc']         = '';
$_lang['formalicious.field.value.label_selected']               = 'Ausgewählt';
$_lang['formalicious.field.value.label_selected_desc']          = '';

$_lang['formalicious.advanced']                                 = 'Erweitert';
$_lang['formalicious.advanced.desc']                            = 'Erweiterte Formular Einstellungen.';

$_lang['formalicious.advanced.label_prehooks']                  = 'Prehooks';
$_lang['formalicious.advanced.label_prehooks_desc']             = 'Kommaseparierte Liste von FormIt prehooks, die ausgeführt werden, wenn das Formular geladen wird.';
$_lang['formalicious.advanced.label_posthooks']                 = 'Posthooks';
$_lang['formalicious.advanced.label_posthooks_desc']            = 'Kommaseparierte Liste von FormIt posthooks, die nach dem Absenden des Formulares ausgeführt werden. Die Hooks werden nach erfolgreicher Validierung ausgeführt.';

$_lang['formalicious.advanced.parameters']                      = 'Parameters';
$_lang['formalicious.advanced.parameters.desc']                 = 'Hinzufügen zusätzlicher FormIt Parameter. Diese werden dem FormIt Snippet Call hinzugefügt, z.B \'&formTpl=`customFormTpl`\'.';
$_lang['formalicious.advanced.parameters.create']               = 'Parameter hinzufügen';
$_lang['formalicious.advanced.parameters.update']               = 'Parameter bearbeiten';
$_lang['formalicious.advanced.parameters.remove']               = 'Parameter entfernen';
$_lang['formalicious.advanced.parameters.remove_confirm']       = 'Willst Du diesen Parameter wirklich entfernen?';

$_lang['formalicious.advanced.parameters.label_key']            = 'Parameter Schlüssel';
$_lang['formalicious.advanced.parameters.label_key_desc']       = '';
$_lang['formalicious.advanced.parameters.label_value']          = 'Parameter Wert';
$_lang['formalicious.advanced.parameters.label_value_desc']     = '';

$_lang['formalicious.default_view']                             = 'Standardansicht';
$_lang['formalicious.admin_view']                               = 'Admin-Ansicht';
$_lang['formalicious.back_to_forms']                            = 'Zurück zu den Formularen';
$_lang['formalicious.active_step']                              = 'Aktiver Schritt';
$_lang['formalicious.new_step']                                 = 'Neuer Schritt';
$_lang['formalicious.no_forms']                                 = 'Füge Kategorien für Deine Formulare hinzu. Klicke auf "Admin-Ansicht", um die Kategorien zu bearbeiten';
$_lang['formalicious.form_err_ae']                              = 'Ein Formular mit demselben Namen ist bereits vorhanden. Geben Sie einen anderen Namen an.';
$_lang['formalicious.form_err_posthooks']                       = 'Die Hooks spam, email and redirect werden automatisch von Formalicious hinzugefügt. Sie brauchen nicht extra angegeben zu werden.';
$_lang['formalicious.form_not_exists']                          = 'Formular mit der ID "[[+id]]" wurde nicht gefunden.';
$_lang['formalicious.formit_view_form']                         = 'View in FormIt';

$_lang['formalicious.submit']                                   = 'Abschicken';
$_lang['formalicious.next']                                     = 'Nächste';
$_lang['formalicious.prev']                                     = 'Zurück';

$_lang['formalicious.contentblocks_input']                      = 'Formalicious Formular Auswahl';
$_lang['formalicious.contentblocks_input.description']          = 'Erlaubt die Auswahl eines vorhandenen Formulars, das in den Inhalt eingefügt wird.';
