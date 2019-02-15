<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$_lang['formalicious']                                          = 'Formalicious';
$_lang['formalicious.desc']                                     = 'Самый простой и мощный генератор форм для MODX.';

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

$_lang['formalicious.category']                                 = 'Категория';
$_lang['formalicious.categories']                               = 'Категории';
$_lang['formalicious.categories.desc']                          = 'Создавайте категории для упорядочивания ваших форм. Они будут отабражены вкладками в общей панели форм.';
$_lang['formalicious.categories.create']                        = 'Создать категорию';
$_lang['formalicious.categories.update']                        = 'Изменить категорию';
$_lang['formalicious.categories.remove']                        = 'Удалить категорию';
$_lang['formalicious.categories.remove_confirm']                = 'Вы уверены, что хотите удалить эту категорию?';

$_lang['formalicious.categories.label_name']                    = 'название';
$_lang['formalicious.categories.label_name_desc']               = '';
$_lang['formalicious.categories.label_description']             = 'Описание';
$_lang['formalicious.categories.label_description_desc']        = '';
$_lang['formalicious.categories.label_published']               = 'опубликованный';
$_lang['formalicious.categories.label_published_desc']          = '';

$_lang['formalicious.fieldtype']                                = 'Тип поля';
$_lang['formalicious.fieldtypes']                               = 'Типы полей';
$_lang['formalicious.fieldtypes.desc']                          = 'Форма состоит из нескольких полей. Они могут быть разных типов, например text или email. Formalicious поставляется со всеми необходимыми типами полей для создания крутых форм, но вы можете добавить и свои собственные.';
$_lang['formalicious.fieldtypes.create']                        = 'Создать тип поля';
$_lang['formalicious.fieldtypes.update']                        = 'Изменить тип поля';
$_lang['formalicious.fieldtypes.remove']                        = 'Удалить тип поля';
$_lang['formalicious.fieldtypes.remove_confirm']                = 'Вы уверены, что хотите удалить эту тип поля?';
$_lang['formalicious.fieldtypes.duplicate']                     = 'Дубликат типа поля';

$_lang['formalicious.fieldtypes.label_name']                    = 'Название';
$_lang['formalicious.fieldtypes.label_name_desc']               = '';
$_lang['formalicious.fieldtypes.label_tpl']                     = 'Чанк оформления';
$_lang['formalicious.fieldtypes.label_tpl_desc']                = 'Имя чанка, который будет использован для оформления этого типа поля.';
$_lang['formalicious.fieldtypes.label_fields']                  = 'поля';
$_lang['formalicious.fieldtypes.label_fields_desc']             = '';
$_lang['formalicious.fieldtypes.label_values']                  = 'Ценности';
$_lang['formalicious.fieldtypes.label_values_desc']             = 'Это поле содержит значения?';
$_lang['formalicious.fieldtypes.label_answertpl']               = 'Чанк для значений';
$_lang['formalicious.fieldtypes.label_answertpl_desc']          = 'Имя чанка, который будет использован для оформления значений этого типа поля. Требуется для элементов selectboxes, checkboxes и radio.';
$_lang['formalicious.fieldtypes.label_validation']              = 'Валидаторы';
$_lang['formalicious.fieldtypes.label_validation_desc']         = 'Список валидаторов FormIt, через запятую, которые будут проверять корректность заполнения этого поля. Смотрите весь список валидаторов на https://docs.modx.com/extras/revo/formit/formit.validators';
$_lang['formalicious.fieldtypes.label_icon']                    = 'Иконка';
$_lang['formalicious.fieldtypes.label_icon_desc']               = 'Иконка будет показана при выборе этого типа поля для добавления в форму.';

$_lang['formalicious.form']                                     = 'форму';
$_lang['formalicious.forms']                                    = 'формы';
$_lang['formalicious.forms.create']                             = 'Создать форму';
$_lang['formalicious.forms.update']                             = 'Изменить форму';
$_lang['formalicious.forms.remove']                             = 'Удалить форму';
$_lang['formalicious.forms.remove_confirm']                     = 'Вы уверены, что хотите удалить эту форму?';
$_lang['formalicious.forms.duplicate']                          = 'Скопировать форму';

$_lang['formalicious.settings']                                 = 'Настройки формы';
$_lang['formalicious.settings.desc']                            = 'Here you can manage the form settings. Here you can set up a \'thank you page\' where the visitor will send to after he fills in the form.';

$_lang['formalicious.settings.email.desc']                      = 'Here you can manage the email that will be sent when a visitor completes the form, to send an email you need to set up the following settings.';
$_lang['formalicious.settings.fair.desc']                       = 'Here you can manage the auto-reply email that will be sent to the visitor when he completes the form, to send an auto-reply email you need to set up the following settings.';

$_lang['formalicious.settings.label_name']                      = 'Название';
$_lang['formalicious.settings.label_name_desc']                 = 'This is the name of the form, this name is only visible within Formalicious and is for your own overview.';
$_lang['formalicious.settings.label_email']                     = 'Email';
$_lang['formalicious.settings.label_email_desc']                = 'When filled an email will be sent after the visitor completes the form.';
$_lang['formalicious.settings.label_emailto']                   = 'Отправить на email';
$_lang['formalicious.settings.label_emailto_desc']              = 'When filled the form will be sent to this emailaddress. For multiple addresses, enter those comma separately, for example: info@companyname.com,admin@companyname.com.';
$_lang['formalicious.settings.label_emailsubject']              = 'Тема email';
$_lang['formalicious.settings.label_emailsubject_desc']         = 'This is the subject of the e-mail that will be sent when a visitor completes the form. For example: A contact form has been filled in.';
$_lang['formalicious.settings.label_emailcontent']              = 'Заголовок email';
$_lang['formalicious.settings.label_emailcontent_desc']         = 'This is the introtext of the e-mail that will be sent when a visitor completes the form. For example A contact form has been filled in within the website. An answer must be sent within 2 - 3 days.';
$_lang['formalicious.settings.label_redirectto']                = 'Перенаправить на';
$_lang['formalicious.settings.label_redirectto_desc']           = 'When filled the visitor will be redirected to this resource when he fills in a form. You can create this page within the tree structure on the left side. Always make sure that the resource can not be found within Google and the website by disabling this in the SEO tab of the resource.';
$_lang['formalicious.settings.label_saveform']                  = 'Сохранять отправленные формы';
$_lang['formalicious.settings.label_saveform_desc']             = 'When filled all the completed forms to be saved? The forms are then stored within FormIt tha can be found under the \'components\' menu.';
$_lang['formalicious.settings.label_published']                 = 'Опубликована';
$_lang['formalicious.settings.label_published_desc']            = 'When filled the form will be available.';
$_lang['formalicious.settings.label_published_from']            = 'Publication date';
$_lang['formalicious.settings.label_published_from_desc']       = 'When a publication date is filled the form will be available when this date is reached.';
$_lang['formalicious.settings.label_published_till']            = 'Un-publication date';
$_lang['formalicious.settings.label_published_till_desc']       = 'When an un-publication date is filled the form publication will be undone when this date is reached.';
$_lang['formalicious.settings.label_fiaremail']                 = 'Отправить авто-ответ';
$_lang['formalicious.settings.label_fiaremail_desc']            = 'When filled an auto reply email will be sent to the visitor after he completes the form.';
$_lang['formalicious.settings.label_fiaremailto']               = 'Выберите поле email';
$_lang['formalicious.settings.label_fiaremailto_desc']          = 'Select the email field where the auto-reply email should be sent. If no fields are available, first add fields to the form via the tab \'Form fields\'.';
$_lang['formalicious.settings.label_fiaremailfrom']             = 'отправителя email';
$_lang['formalicious.settings.label_fiaremailfrom_desc']        = 'Enter the email address of the auto-reply email. For example, info@companyname.com. The visitor sees this as the sender in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailsubject']          = 'Тема email';
$_lang['formalicious.settings.label_fiaremailsubject_desc']     = 'This is the subject of the auto-reply email. This is the subject the visitor sees when they receive this e-mail in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailcontent']          = 'Заголовок email';
$_lang['formalicious.settings.label_fiaremailcontent_desc']     = 'This is the introtext of the auto-reply email. For example: Hello! Thank you for filling in our contact form. Within 2 - 3 days you can expect a response from us. With kind regards, company name X.';
$_lang['formalicious.settings.label_fiaremailattachment']       = 'Auto-reply email attachment';
$_lang['formalicious.settings.label_fiaremailattachment_desc']  = 'Select a file that will be sent as an attachment for the auto-reply email. This file is limited to the following file types: pdf, doc, docx, png, jpg, gif. The file must have a maximum file size of 8 MB.';

$_lang['formalicious.step']                                     = 'поле';
$_lang['formalicious.steps']                                    = 'поля';
$_lang['formalicious.steps.desc']                               = 'Manage the form fields. A step can be renamed by double-clicking the text. You can rearrange the steps by dragging the tabs into the desired order.';
$_lang['formalicious.step.create']                              = 'Добавить этап';
$_lang['formalicious.step.update']                              = 'Изменить этап';
$_lang['formalicious.step.remove']                              = 'Удалить этап';
$_lang['formalicious.step.remove_confirm']                      = 'Вы уверены, что хотите удалить этот этап? Это также удаляет все дочерние поля.';
$_lang['formalicious.step.preview']                             = 'Предварительный просмотр';

$_lang['formalicious.step.label_title']                         = 'заглавие';
$_lang['formalicious.step.label_title_desc']                    = 'Название шага.';
$_lang['formalicious.step.label_button']                        = 'Название кнопки';
$_lang['formalicious.step.label_button_desc']                   = 'The title of the Отправить or Дальше button, when empty then will be "Отправить" or "Дальше" used by default.';

$_lang['formalicious.field.create']                             = 'Добавить поле';
$_lang['formalicious.field.update']                             = 'Изменить поле';
$_lang['formalicious.field.remove']                             = 'Удалить поле';
$_lang['formalicious.field.remove_confirm']                     = 'Вы уверены, что хотите удалить это поле?';
$_lang['formalicious.field.duplicate']                          = 'Дубликат поля';

$_lang['formalicious.field.label_type']                         = 'Тип';
$_lang['formalicious.field.label_type_desc']                    = '';
$_lang['formalicious.field.label_title']                        = 'заглавие';
$_lang['formalicious.field.label_title_desc']                   = '';
$_lang['formalicious.field.label_description']                  = 'Описание';
$_lang['formalicious.field.label_description_desc']             = 'Прилагаемое описание, которое показано ниже или выше поля.';
$_lang['formalicious.field.label_placeholder']                  = 'Плейсхолдер';
$_lang['formalicious.field.label_placeholder_desc']             = 'Поясняющий текст, который подскажет пользователю, что именно нужно заполнить. Например: "Пожалуйста, укажите своё имя".';
$_lang['formalicious.field.label_property']                     = 'Размер заголовка';
$_lang['formalicious.field.label_property_desc']                = 'Размер шрифта заголовка.';
$_lang['formalicious.field.label_published']                    = 'опубликованный';
$_lang['formalicious.field.label_published_desc']               = '';
$_lang['formalicious.field.label_required']                     = 'необходимые';
$_lang['formalicious.field.label_required_desc']                = '';

$_lang['formalicious.field.value']                              = 'значение';
$_lang['formalicious.field.values']                             = 'Ценности';
$_lang['formalicious.field.value.create']                       = 'Добавить значение';
$_lang['formalicious.field.value.update']                       = 'Изменить значение';
$_lang['formalicious.field.value.remove']                       = 'Удалить значение';
$_lang['formalicious.field.value.remove_confirm']               = 'Вы уверены, что хотите удалить это значение?';

$_lang['formalicious.field.value.label_name']                   = 'название';
$_lang['formalicious.field.value.label_name_desc']              = '';
$_lang['formalicious.field.value.label_published']              = 'опубликованный';
$_lang['formalicious.field.value.label_published_desc']         = '';
$_lang['formalicious.field.value.label_selected']               = 'выбранный';
$_lang['formalicious.field.value.label_selected_desc']          = '';

$_lang['formalicious.advanced']                                 = 'Продвинутые настройки';
$_lang['formalicious.advanced.desc']                            = 'Продвинутые настройки формы.';

$_lang['formalicious.advanced.label_prehooks']                  = 'Прехуки';
$_lang['formalicious.advanced.label_prehooks_desc']             = 'Список прехуков FormIt через запятую, которые будут выполнены при загрузке формы.';
$_lang['formalicious.advanced.label_posthooks']                 = 'Постхуки';
$_lang['formalicious.advanced.label_posthooks_desc']            = 'Список постхуков FormIt через запятую, которые будут выполнены при отправке формы. Хуки запускаются только после успешной валидации формы.';

$_lang['formalicious.advanced.parameters']                      = 'Параметры';
$_lang['formalicious.advanced.parameters.desc']                 = 'Вы можете указать особые параметры, которые будут добавлены при вызове сниппета FormIt. Например: \'&formTpl=`customFormTpl`\'.';
$_lang['formalicious.advanced.parameters.create']               = 'Добавить параметр';
$_lang['formalicious.advanced.parameters.update']               = 'Изменить параметр';
$_lang['formalicious.advanced.parameters.remove']               = 'Удалить параметр';
$_lang['formalicious.advanced.parameters.remove_confirm']       = 'Вы уверены, что хотите удалить этот параметр?';

$_lang['formalicious.advanced.parameters.label_key']            = 'Ключ параметра';
$_lang['formalicious.advanced.parameters.label_key_desc']       = '';
$_lang['formalicious.advanced.parameters.label_value']          = 'Значение параметра';
$_lang['formalicious.advanced.parameters.label_value_desc']     = '';

$_lang['formalicious.default_view']                             = 'Просмотр по умолчанию';
$_lang['formalicious.admin_view']                               = 'Вид администратора';
$_lang['formalicious.back_to_forms']                            = 'Вернуться к формам';
$_lang['formalicious.active_step']                              = 'Активный шаг';
$_lang['formalicious.new_step']                                 = 'Новый шаг';
$_lang['formalicious.no_forms']                                 = 'Пожалуйста, добавьте несколько категорий для ваших форм. Нажмите на "Вид администратора" для управления категориями.';
$_lang['formalicious.form_err_ae']                              = 'Форма с таким именем уже существует, укажите другое имя.';
$_lang['formalicious.form_err_posthooks']                       = 'Хуки spam, email и redirect добавляются автоматически, вам не нужно указывать их здесь.';
$_lang['formalicious.form_not_exists']                          = 'Форма с идентификатором "[[+id]]" не найдена.';
$_lang['formalicious.formit_view_form']                         = 'View in FormIt';

$_lang['formalicious.submit']                                   = 'Отправить';
$_lang['formalicious.next']                                     = 'Дальше';
$_lang['formalicious.prev']                                     = 'предыдущий';

$_lang['formalicious.contentblocks_input']                      = 'Выбор формы Formalicious';
$_lang['formalicious.contentblocks_input.description']          = 'Позволяет вам выбрать сохранённую форму для добавления на страницу.';
