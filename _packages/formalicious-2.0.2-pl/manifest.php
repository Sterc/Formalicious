<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'Formalicious is proprietary software, developed by Sterc and distributed through modmore.com. By purchasing Formalicious via https://www.modmore.com/formalicious/, you have received a usage license for a single (1) MODX Revolution installation, including one year (starting on date of purchase) of email support.

While we hope Formalicious is useful to you and we will try to help you successfully use Formalicious, modmore or Sterc is not liable for loss of revenue, data, damages or other financial loss resulting from the installation or use of Formalicious.

By using and installing this package, you acknowledge that you shall only use this on a single MODX installation.

Redistribution in any shape or form is strictly prohibited. You may customize or change the provided source code to tailor Formalicious for your own use, as long as no attempt is made to remove license protection measures. By changing source code you acknowledge you void the right to support unless coordinated with modmore support.
',
    'readme' => '--------------------
Formalicious
--------------------
Author: Sterc <modx@sterc.nl>
--------------------

Formalicious is the most powerful and easiest MODX form builder, with built-in multi-step forms, 8 field types, validation and the ability to use hooks and other advanced FormIt features.

Important! Since Formalicious 2.0.0 we refactored some snippets and chunks. The snippet RenderForm is replaced with FormaliciousRenderForm.
Please check your snippet and the script properties and check if the chunks/templates of the \'Fieldtypes\' are correct.
',
    'changelog' => 'Version 2.0.2-pl
- Set currentUrl with step=1 when steps are there
- Make the id column on fields visible

Version 2.0.1-pl
--------------------------
- Add sterc extra settings when not existing

Version 2.0.0-pl
--------------------------
- Add form DB fields published_from and published_till to auto (de)publication forms
- Add field answer DB field selected to set default selected
- Rich text support for field description and form email content.
- Steps (navigation) above the form
- New parameter stepRedirect to redirect a step to a non resource ID (if stepRedirect is set to \'request\' the step will be redirected to the current REQUEST URL)
- New permissions added
    - formalicious_admin to show/hide admin panel
    - formalicious_tab_fields to show/hide fields tab
    - formalicious_tab_advanced to show/hide advanced tab (formalicious_advanced renamed to formalicious_tab_advanced)
- ExtJS refactored for faster and better UI/UX
    - Step preview fixed
    - Toggleable description, placeholder, required and heading fields for each fieldtype
- RenderForm replaced with FormaliciousRenderForm
- All snippets and chunks are prefixed with Formalicious

Version 1.4.1-pl
--------------------------
- Create database fields on update

Version 1.4.0-pl
--------------------------
- Add field description
- Hide advanced tab based on permissions
- Add heading & description fields
- Add field description
- Change fiarcontent from varchar to text for bigger mails

Version 1.3.1-pl
--------------------------
- Add system setting for disable form saving on install
- Change fiarcontent from varchar to text

Version 1.3.0-pl
--------------------------
- Fixed phptype of some fields in schema of tables (PHP 7 compatibility)
- Added system setting to disable overall form saving functionality
- Added russian lexicon

Version 1.2.1-pl (October 2017)
--------------------------
- Remove the limit from the ContentBlocks input field
- Hide autoreply options when autoreply checkbox is unchecked

Version 1.2.0-pl (August 2nd, 2017)
--------------------------
- Removing default limit from fiaremailto field (#31)
- Add back button to form update view
- Add duplicate option to forms grid (#32)
- Update grid action buttons to use modx font-awesome icons
- Make add step/field buttons more visible
- Add preview option to form fields tab
- Add saveTmpFiles FormIt property to default formTpl
- Add formName FormIt property to default formTpl
- Prefix fiar-attachment field with modx base_path
- Only add email hook when emailto is not empty
- Remove default limit of 20 from field-values grid
- Check for common \'spam,email,redirect\' hooks added by Formalicious when saving posthooks
- Add ID field to form-fields grid
- Make sure prehooks are run before the renderForm snippet

Version 1.1.0-pl (April 19th, 2017)
--------------------------
- Fix setting placeholder for stepParam parameter for renderForm
- Show message when trying to display unpublished form (#6)
- Update radio and checkbox chunks to use correct Bootstrap classes (#28)
- Allow emailTpl and fiarTpl to be overwritten with renderForm snippet parameters (#23)
- Add validate and customValidators parameters to renderForm and formTpl (#23)

Version 1.0.1-pl (February 3rd, 2017)
--------------------------
- Added ContentBlocks support (thanks Mark!)
- Fixed installation issues with MODX installations with custom table-prefixes

Version 1.0.0-pl (February 1st, 2017)
--------------------------
- XS-4 New documentation
- XS-11 Changed height of several dialog windows
- XS-12 Spacing adjustments
- XS-19 Gave the default emails a lighter grey
- XS-20 Modified all en/nl lexicons
- XS-21 Fixed inline editing (removed it)

Version 1.0.0-RC2 (January 27th, 2017)
--------------------------
- [#28] Fixed oldstyle actions
- [#29] Improved this very changelog
- [#40] Create a readme
- [#41] New logo for the modmore site!
- [#XS-42] Autoheight for new-field dialog

Version 1.0.0-RC1 (January 26th, 2017)
--------------------------
- [#34] Improved handling of empty fields
- [#37] Radio button # Select # Checkbox options are now required
- [#38] Allowed files are now mentioned
- [#36] Improved default emails
- [#32] Unused description field is now removed
- [#31] Improved placeholder field usage
- [#30] Mention context-NAME in the "Redirect to" field when creating a new form
- [#27] Fixed file upload in multistep form
- [#22] Improved emailTpl
- [#20 + #23 + #35] Improved styling of buttons
- [#17] Fixed category_id fallback
- [#9 + #12] Fixed empty fields in multistep form
- [#13] Fixed email validation
- [#10] Fixed adding parameters not working properly
- [#7] Now shipped with TV
- [#8] Fixed uninstallation proces
- [#4] "Update type" dialog is now bigger
- [#2] Fixed select form-email-field when creating a form
- [#1] Fixed empty field when creating a form
- [#6] Improved adding fields
- [#5] Improved step-creation flow
- [#3] Replaced form-description with "Email header text"

Version 0.6.0 (2016)
--------------------------
- Create form categories
- Ability to create form steps
- Ability to save forms in FormIt (FormIt V2.2.2#) CMP
- Added ability to setup autoresponder in form
- Updated lexicons
',
    'setup-options' => 'formalicious-2.0.2-pl/setup-options.php',
    'requires' => 
    array (
      'formit' => '>=4.1.1',
    ),
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '941133f01363e726bc2d0c4c9a6a767f',
      'native_key' => 'formalicious',
      'filename' => 'modNamespace/7356ae43763471ac85b60140713b1c45.vehicle',
      'namespace' => 'formalicious',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0f426a325418b71fd7763f7514b1c8dc',
      'native_key' => 'formalicious.branding_url',
      'filename' => 'modSystemSetting/de0122de27520299e2ade2fc8f241b0c.vehicle',
      'namespace' => 'formalicious',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b21d3a669ae6427445fbba5f5e35d320',
      'native_key' => 'formalicious.branding_url_help',
      'filename' => 'modSystemSetting/0982c3550284cdb4bbe8f04e7fe1af4e.vehicle',
      'namespace' => 'formalicious',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c84313397a8ccbc3267348af2ffffa40',
      'native_key' => 'formalicious.saveforms',
      'filename' => 'modSystemSetting/4bdb6ca272361f679e1dbb12990c22f3.vehicle',
      'namespace' => 'formalicious',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ec6beecb4b7661dd2f024975cc19b17b',
      'native_key' => 'formalicious.saveforms_prefix',
      'filename' => 'modSystemSetting/5d3ed7b3ca0cec2b3eb93c971f741533.vehicle',
      'namespace' => 'formalicious',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '016044a6a24876d261e549972b441a82',
      'native_key' => 'formalicious.disallowed_hooks',
      'filename' => 'modSystemSetting/e1dbfb7bee76a6543d46f95fcc342db1.vehicle',
      'namespace' => 'formalicious',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '01e851a3a2c2d1d5877a8b7a8fdba11f',
      'native_key' => 'formalicious.preview_css',
      'filename' => 'modSystemSetting/c2f298b51093123c442de78534bb5a8d.vehicle',
      'namespace' => 'formalicious',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '492edfcc321c09038af61e28c4b96a26',
      'native_key' => 'formalicious.source',
      'filename' => 'modSystemSetting/656bd1f125519fcbc829028c7a98d51f.vehicle',
      'namespace' => 'formalicious',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '96f7eea48edc2620ccd5e100477678a5',
      'native_key' => 'formalicious.use_editor',
      'filename' => 'modSystemSetting/275176d5a27a7f7de2e8fc1ad27a7af2.vehicle',
      'namespace' => 'formalicious',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3245574b85094886643c857c932275d4',
      'native_key' => 'formalicious.editor_menubar',
      'filename' => 'modSystemSetting/f45704ef36a62c6741b4816dd3c49ef4.vehicle',
      'namespace' => 'formalicious',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '419a955601b26e455a44b55bb25a136a',
      'native_key' => 'formalicious.editor_plugins',
      'filename' => 'modSystemSetting/e5cf8fe98d6e7ed79be09c650ca2654e.vehicle',
      'namespace' => 'formalicious',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5375a5c2a7103eea4ae690c10d640ba5',
      'native_key' => 'formalicious.editor_statusbar',
      'filename' => 'modSystemSetting/84eeaa306f74633cbf5bd7e338956def.vehicle',
      'namespace' => 'formalicious',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a3faf500dd46d828f5f3603b43c1f03f',
      'native_key' => 'formalicious.editor_toolbar1',
      'filename' => 'modSystemSetting/9127339a323807c5bac867f30e76b476.vehicle',
      'namespace' => 'formalicious',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e477d50d6de6752b087f2bf54afc3deb',
      'native_key' => 'formalicious.editor_toolbar2',
      'filename' => 'modSystemSetting/b47bd7d4ecbc4af9d3cf547c12c9d886.vehicle',
      'namespace' => 'formalicious',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c7e6e265c0ce3073f567bbdd4c28a687',
      'native_key' => 'formalicious.editor_toolbar3',
      'filename' => 'modSystemSetting/cc79b8803656b54d2c759c9280203ad7.vehicle',
      'namespace' => 'formalicious',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '9bfa37c3b17ea623fd041a0ec04623da',
      'native_key' => NULL,
      'filename' => 'modCategory/5be9a8e680d1f2a602f26b6717478cbb.vehicle',
      'namespace' => 'formalicious',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'bb32be448fa22d4e5db58cd1d56a7324',
      'native_key' => 'formalicious',
      'filename' => 'modMenu/a2f2797ccb05e65bd5a09fac2335d823.vehicle',
      'namespace' => 'formalicious',
    ),
  ),
);