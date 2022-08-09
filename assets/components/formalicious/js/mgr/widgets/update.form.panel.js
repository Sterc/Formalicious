Formalicious.panel.UpdateForm = function(config) {
    config = config || {};

    Ext.apply(config, {
        items       : [{
            html        : '<p>' + _('formalicious.steps.desc') + '</p>',
            bodyCssClass: 'panel-desc'
        }, {
            xtype       : 'panel',
            cls         : 'container',
            items       : [{
                xtype       : 'toolbar',
                cls         : 'x-formalicious-steps-toolbar',
                items       : [{
                    xtype       : 'button',
                    text        : _('formalicious.step.create'),
                    cls         : 'primary-button',
                    handler     : this.createStep,
                    scope       : this
                }, '->', {
                    xtype       : 'label',
                    html        : _('formalicious.active_step') + ':'
                }, {
                    xtype       : 'button',
                    text        : _('formalicious.step.update'),
                    handler     : this.updateStep,
                    scope       : this
                }, {
                    xtype       : 'button',
                    text        : _('formalicious.step.remove'),
                    handler     : this.removeStep,
                    scope       : this
                }]
            }, {
                xtype       : 'formalicious-panel-tabs',
                cls         : 'x-formalicious-steps-tabs'
            }]
        }]
    });

    Formalicious.panel.UpdateForm.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.panel.UpdateForm, MODx.Panel, {
    createStep: function(btn, e) {
        var tabs = Ext.getCmp('formalicious-panel-form-steps');

        if (tabs) {
            var record = {
                form_id : Formalicious.config.record.id
            };

            if (this.createStepWindow) {
                this.createStepWindow.destroy();
            }

            this.createStepWindow = MODx.load({
                xtype       : 'formalicious-window-step-create',
                record      : record,
                closeAction : 'close',
                listeners   : {
                    'success'   : {
                        fn          : function(result) {
                            tabs.addTab(result.a.result.object, true);
                        },
                    }
                }
            });

            this.createStepWindow.setValues(record);
            this.createStepWindow.show(e.target);
        }
    },
    updateStep: function(btn, e) {
        var tabs = Ext.getCmp('formalicious-panel-form-steps');

        if (tabs) {
            var record = tabs.getActiveTab();

            if (this.updateStepWindow) {
                this.updateStepWindow.destroy();
            }

            this.updateStepWindow = MODx.load({
                xtype       : 'formalicious-window-step-update',
                record      : record.record,
                closeAction : 'close',
                listeners   : {
                    'success'   : {
                        fn          : function(result) {
                            tabs.updateTab(result.a.result.object);
                        },
                        scope       : this
                    }
                }
            });

            this.updateStepWindow.setValues(record.record);
            this.updateStepWindow.show(e.target);
        }
    },
    removeStep: function(btn, e) {
        var tabs = Ext.getCmp('formalicious-panel-form-steps');

        if (tabs) {
            var record = tabs.getActiveTab();

            MODx.msg.confirm({
                title   : _('formalicious.step.remove'),
                text    : _('formalicious.step.remove_confirm'),
                url     : Formalicious.config.connector_url,
                params  : {
                    action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Steps\\Remove',
                    id      : record.record.id
                },
                listeners   : {
                    'success'   : {
                        fn         : function() {
                            tabs.removeTab(record);
                        },
                        scope      : this
                    }
                }
            });
        }
    }
});

Ext.reg('formalicious-panel-update-form', Formalicious.panel.UpdateForm);

Formalicious.window.CreateStep = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.step.create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Steps\\Create'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'form_id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.step.label_title'),
            description : MODx.expandHelp ? '' : _('formalicious.step.label_title_desc'),
            name        : 'title',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.step.label_title_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.step.label_button'),
            description : MODx.expandHelp ? '' : _('formalicious.step.label_button_desc'),
            name        : 'button',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.step.label_button_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.CreateStep.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.CreateStep, MODx.Window);

Ext.reg('formalicious-window-step-create', Formalicious.window.CreateStep);

Formalicious.window.UpdateStep = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.step.update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Steps\\Update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'hidden',
            name        : 'form_id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.step.label_title'),
            description : MODx.expandHelp ? '' : _('formalicious.step.label_title_desc'),
            name        : 'title',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.step.label_title_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.step.label_button'),
            description : MODx.expandHelp ? '' : _('formalicious.step.label_button_desc'),
            name        : 'button',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.step.label_button_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.UpdateStep.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.UpdateStep, MODx.Window);

Ext.reg('formalicious-window-step-update', Formalicious.window.UpdateStep);

Formalicious.panel.Tabs = function(config) {
    config = config || {};

    Ext.apply(config, {
        id          : 'formalicious-panel-form-steps',
        hideMode    : 'offsets',
        listeners   : {
            'afterrender' : {
                fn          : this.setTabs,
                scope       : this
            },
            'reorder'   : function(tabpanel) {
                var order = [];

                Ext.each(tabpanel.items.items, (function(record) {
                    order.push(record.record.id);
                }).bind(this));

                MODx.Ajax.request({
                    url     : Formalicious.config.connector_url,
                    params  : {
                        action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Steps\\Sort',
                        order   : order.join(',')
                    },
                    listeners   : {
                        'success'   : {

                        }
                    }
                });
            }
        }
    });

    Formalicious.panel.Tabs.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.panel.Tabs, Ext.ux.panel.DDTabPanel, {
    setTabs: function() {
        MODx.Ajax.request({
            url     : Formalicious.config.connector_url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Steps\\GetList',
                form_id : MODx.request.id
            },
            listeners   : {
                'success'   : {
                    fn          : function(data) {
                        Ext.each(data.results, (function(record) {
                            this.addTab(record, false);
                        }).bind(this));

                        this.setActiveTab(0);
                    },
                    scope       : this
                }
            }
        });
    },
    addTab: function(record, active) {
        var tab = this.add({
            autoHeight  : true,
            title       : record.title,
            record      : record,
            items       : [{
                xtype       : 'formalicious-grid-form-fields',
                id          : 'formalicious-panel-form-step-' + record.id,
                cls         : 'main-wrapper',
                preventRender : true,
                step_id     : record.id
            }]
        });

        if (active) {
            this.setActiveTab(tab);
        }
    },
    updateTab: function(record) {
        this.activeTab.record = record;

        this.activeTab.setTitle(record.title);
    },
    removeTab: function(record) {
        this.remove(record);
    }
});

Ext.reg('formalicious-panel-tabs', Formalicious.panel.Tabs);

Formalicious.grid.FormFields = function(config) {
    config = config || {};

    config.bbar = [{
        text        : '<i class="icon icon-plus"></i>' + _('formalicious.field.create'),
        cls         : 'primary-button',
        handler     : this.createField,
        scope       : this,
        step        : config.step
    },{
        text        : '<i class="icon icon-search"></i>' + _('formalicious.step.preview'),
        handler     : this.showPreview,
        scope       : this,
        step        : config.step
    }];

    var columns = [{
        header      : 'ID',
        dataIndex   : 'id',
        width       : 10
    },{
        header      : _('formalicious.field.label_title'),
        dataIndex   : 'title'
    }, {
        header      : _('formalicious.field.label_type'),
        dataIndex   : 'type_name',
        width       : 250,
        fixed       : true
    }, {
        header      : _('formalicious.field.label_published'),
        dataIndex   : 'published',
        width       : 125,
        fixed       : true,
        renderer    : this.renderBoolean,
        editable    : true,
        editor      : {
            xtype       : 'modx-combo-boolean'
        }
    }, {
        header      : _('actions'),
        width       : 125,
        fixed       : true,
        renderer    : this.renderActions
    }];

    Ext.applyIf(config, {
        columns     : columns,
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\GetList',
            step_id     : config.step_id
        },
        autosave    : true,
        save_action : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\UpdateFromGrid',
        fields      : ['id', 'step_id', 'title', 'placeholder', 'description', 'directional', 'type', 'required', 'published', 'rank', 'property', 'type_name', 'type_values'],
        paging      : false,
        remoteSort  : true,
        enableDragDrop : true,
        ddGroup     : 'formalicious-grid-fields-' + config.step,
        listeners   : {
            'afterrender' : {
                fn          : this.sortFields,
                scope       : this
            }
        }
    });

    Formalicious.grid.FormFields.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.FormFields, MODx.grid.Grid, {
    getMenu: function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.field.update'),
            handler : this.updateField
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-copy"></i>' + _('formalicious.field.duplicate'),
            handler : this.duplicateField
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.field.remove'),
            handler : this.removeField
        }];
    },
    sortFields: function() {
        new Ext.dd.DropTarget(this.getView().mainBody, {
            ddGroup     : this.config.ddGroup,
            notifyDrop  : function(dd, e, data) {
                var grid    = data.grid,
                    sels    = grid.getSelectionModel().getSelections(),
                    items   = grid.getStore().data.items,
                    index   = dd.getDragData(e).rowIndex;

                if (undefined !== index) {
                    if (grid.getSelectionModel().hasSelection()) {
                        for (i = 0; i < sels.length; i++) {
                            grid.getStore().remove(grid.getStore().getById(sels[i].id));
                            grid.getStore().insert(index, sels[i]);
                        }

                        grid.getSelectionModel().selectRecords(sels);
                    }

                    var order = [];

                    Ext.each(items, (function(record) {
                        order.push(record.id);
                    }).bind(this));

                    MODx.Ajax.request({
                        url     : Formalicious.config.connector_url,
                        params  : {
                            action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Sort',
                            order   : order.join(',')
                        },
                        listeners   : {
                            'success'   : {
                                fn          : function() {
                                    grid.getSelectionModel().clearSelections(true);
                                },
                                scope       : this
                            }
                        }
                    });
                }
            }
        });
    },
    createField: function(btn, e) {
        if (this.createFieldWindow) {
            this.createFieldWindow.destroy();
        }

        this.createFieldWindow = MODx.load({
            xtype       : 'formalicious-window-field-create',
            closeAction : 'close',
            record      : {
                step_id     : this.config.step_id
            },
            listeners   : {
                'success'   : {
                    fn          : function(result) {
                        this.updateField(btn, e, result.a.object);
                        this.refresh();
                    },
                    scope       : this
                }
            }
        });

        this.createFieldWindow.setValues({
            step_id : this.config.step_id
        });
        this.createFieldWindow.show(e.target);
    },
    updateField: function(btn, e, forcedData) {
        var record;

        if (!forcedData) {
            record = this.menu.record;
        } else{
            record = forcedData;
        }

        if (this.updateFieldWindow) {
            this.updateFieldWindow.destroy();
        }

        this.updateFieldWindow = MODx.load({
            xtype       : 'formalicious-window-field-update',
            record      : record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateFieldWindow.setValues(record);
        this.updateFieldWindow.show(e.target);
    },
    duplicateField: function(btn, e) {
        if (this.duplicateFieldWindow) {
            this.duplicateFieldWindow.destroy();
        }

        var record = Ext.apply({}, {
            title : _('duplicate_of', {
                name : this.menu.record.title
            })
        }, this.menu.record);

        this.duplicateFieldWindow = MODx.load({
            xtype       : 'formalicious-window-field-duplicate',
            record      : record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.duplicateFieldWindow.setValues(record);
        this.duplicateFieldWindow.show(e.target);
    },
    showPreview: function(btn,e) {
        MODx.Ajax.request({
            url     : Formalicious.config.connector_url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\Preview',
                form_id : MODx.request.id,
                step_id : this.config.step_id
            },
            listeners   : {
                'success'   : {
                    fn          : function(data) {
                        if (this.previewFormWindow) {
                            this.previewFormWindow.destroy();
                        }

                        this.previewFormWindow = MODx.load({
                            xtype       : 'formalicious-window-preview',
                            closeAction : 'close',
                            record      : {
                                html        : data.object.output
                            }
                        });

                        this.previewFormWindow.show(e.target);
                    },
                    scope       : this
                }
            }
        });
    },
    removeField: function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.field.remove'),
            text    : _('formalicious.field.remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Remove',
                id      : this.menu.record.id
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    },
    renderActions: function(value, metaData, record, rowIndex, colIndex, store) {
        var tpl = new Ext.XTemplate('<tpl for=".">' +
            '<tpl if="actions !== null">' +
                '<ul class="x-grid-actions">' +
                    '<tpl for="actions">' +
                        '<li><button type="button" class="x-btn x-btn-small {className}" title="{title}">{text}</button></li>' +
                    '</tpl>' +
                '</ul>' +
            '</tpl>' +
        '</tpl>', {
             compiled : true
         });

        return tpl.apply({
            actions : [{
                className   : 'icon icon-pencil action-edit',
                title       : _('formalicious.forms.update'),
                text        : ''
            }, {
                className   : 'icon icon-clone action-duplicate',
                title       : _('formalicious.forms.duplicate'),
                text        : ''
            }, {
                className   : 'icon icon-times action-remove',
                text        : '',
                title       : _('formalicious.forms.remove')
            }]
        });
    },
    renderBoolean: function(d, c) {
        c.css = 1 === parseInt(d) || d ? 'green' : 'red';

        return 1 === parseInt(d) || d ? _('yes') : _('no');
    },
    onClick: function(e) {
        var btn = e.getTarget();
        var cls = btn.className.split(' ');
        var record = this.getSelectionModel().getSelected();

        if (record) {
            this.menu.record = record.data;

            if (-1 !== cls.indexOf('action-edit')) {
                this.updateField(e.getTarget(), e);
            } else if (-1 !== cls.indexOf('action-duplicate')) {
                this.duplicateField(e.getTarget(), e);
            } else if (-1 !== cls.indexOf('action-remove')) {
                this.removeField(e.getTarget(), e);
            }
        }

        return false;
    }
});

Ext.reg('formalicious-grid-form-fields', Formalicious.grid.FormFields);

Formalicious.window.CreateField = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        width       : 500,
        autoHeight  : true,
        title       : _('formalicious.field.create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Create'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'step_id'
        }, {
            layout      :'column',
            items       : this.getFieldTypes()
        }],
        buttons     : [{
            text        : _('cancel'),
            handler     : function() {
                if (config.closeAction !== 'close') {
                    this.hide();
                } else {
                    this.close();
                }
            },
            scope       : this
        }]
    });

    Formalicious.window.CreateField.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.CreateField, MODx.Window, {
    getFieldTypes: function() {
        var items = [];

        Ext.each(Formalicious.config.fieldtypes, (function(type, index) {
            if (index % Math.ceil(Formalicious.config.fieldtypes.length / 3) === 0) {
                items.push({
                    columnWidth : .33,
                    items       : []
                });
            }

            items[items.length - 1].items.push({
                xtype       : 'button',
                text        : type.name,
                name        : type.name,
                type        : type.id,
                cls         : 'x-btn-formalicious',
                handler     : this.submit,
                scope       : this
            });
        }).bind(this));

        return items;
    },
    submit: function(btn, e) {
        var form = this.fp.getForm();

        if (form.isValid()) {
            MODx.Ajax.request({
                url         : Formalicious.config.connector_url,
                params      : {
                    action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Create',
                    step_id     : form.findField('step_id').getValue(),
                    type        : btn.type
                },
                listeners   : {
                    'success'   : {
                        fn          : function(result) {
                            if (this.config.success) {
                                Ext.callback(this.config.success, this.config.scope || this, [this, result]);
                            }

                            this.fireEvent('success', {
                                f : this,
                                a : result
                            });

                            if (this.config.closeAction !== 'close') {
                                this.hide();
                            } else {
                                this.close();
                            }
                        },
                        scope       : this
                    }
                }
            });
        }
    }
});

Ext.reg('formalicious-window-field-create', Formalicious.window.CreateField);

Formalicious.window.UpdateField = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.field.update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'formalicious-combo-fieldtype',
            fieldLabel  : _('formalicious.field.label_type'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_type_desc'),
            name        : 'type',
            anchor      : '100%',
            allowBlank  : false,
            listeners   : {
                'select'    : {
                    fn          : this.onUpdateFieldType,
                    scope       : this
                },
                'afterrender' : {
                    fn          : this.onUpdateFieldType,
                    scope       : this
                }
            }
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_type_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.field.label_title'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_title_desc'),
            name        : 'title',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_title_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.field.label_placeholder'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_placeholder_desc'),
            id          : 'formalicious-field-update-placeholder',
            name        : 'placeholder',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_placeholder_desc'),
            id          : 'formalicious-field-update-placeholder-desc',
            cls         : 'desc-under'
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('formalicious.field.label_description'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_description_desc'),
            name        : 'description',
            anchor      : '100%',
            listeners   : {
                afterrender : {
                    fn          : function(event) {
                        if (Formalicious.loadRTE) {
                            Formalicious.loadRTE(event.id, {
                                plugins     : MODx.config['formalicious.editor_plugins'],
                                menubar     : MODx.config['formalicious.editor_menubar'],
                                statusbar   : parseInt(MODx.config['formalicious.editor_statusbar']) === 1,
                                toolbar1    : MODx.config['formalicious.editor_toolbar1'],
                                toolbar2    : MODx.config['formalicious.editor_toolbar2'],
                                toolbar3    : MODx.config['formalicious.editor_toolbar3'],
                                height      : 75
                            });
                        }
                    }
                }
            }
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_description_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'formalicious-combo-heading',
            fieldLabel  : _('formalicious.field.label_property'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_property_desc'),
            id          : 'formalicious-field-update-property',
            name        : 'property',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_property_desc'),
            id          : 'formalicious-field-update-property-desc',
            cls         : 'desc-under'
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.label_required'),
            id          : 'formalicious-field-update-required',
            name        : 'required',
            inputValue  : 1
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.label_published'),
            name        : 'published',
            inputValue  : 1
        }, {
            xtype       : 'formalicious-grid-field-values',
            id          : 'formalicious-field-update-values',
            field_id    : config.record.id
        }]
    });

    Formalicious.window.UpdateField.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.UpdateField, MODx.Window, {
    onUpdateFieldType: function(tf) {
        var record = tf.getStore().getAt(tf.getStore().findExact('id', tf.getValue()));

        if (record) {
            var fields = record.data.fields.split(',');

            if (record.data.values) {
                fields.push('values');
            }

            Ext.each(['placeholder', 'property', 'required', 'values'], (function(field) {
                if (-1 === fields.indexOf(field)) {
                    Ext.getCmp('formalicious-field-update-' + field).hide();

                    if (Ext.getCmp('formalicious-field-update-' + field + '-desc')) {
                        Ext.getCmp('formalicious-field-update-' + field + '-desc').hide();
                    }
                } else {
                    Ext.getCmp('formalicious-field-update-' + field).show();

                    if (Ext.getCmp('formalicious-field-update-' + field + '-desc')) {
                        Ext.getCmp('formalicious-field-update-' + field + '-desc').show();
                    }
                }
            }).bind(this));
        }
    }
});

Ext.reg('formalicious-window-field-update', Formalicious.window.UpdateField);

Formalicious.window.DuplicateField = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.field.duplicate'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Fields\\Duplicate'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.field.label_title'),
            description : MODx.expandHelp ? '' : _('formalicious.field.label_title_desc'),
            name        : 'title',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.field.label_title_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.DuplicateField.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.DuplicateField, MODx.Window);

Ext.reg('formalicious-window-field-duplicate', Formalicious.window.DuplicateField);

Formalicious.window.Preview = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        width       : 500,
        title       : _('formalicious.step.preview'),
        items       : [{
            autoEl      : {
                tag         : 'div',
                id          : 'formalicious-preview-panel',
                html        : config.record.html
            }
        }],
        buttons     : [{
            text        : _('cancel'),
            handler     : function() {
                if (config.closeAction !== 'close') {
                    this.hide();
                } else {
                    this.close();
                }
            },
            scope       : this
        }]
    });

    Formalicious.window.Preview.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.Preview, MODx.Window);

Ext.reg('formalicious-window-preview', Formalicious.window.Preview);

Formalicious.grid.FieldValues = function(config) {
    config = config || {};

    config.tbar = [{
        text    : _('formalicious.field.value.create'),
        cls     : 'primary-button',
        handler : this.createValue,
        scope   : this
    }];

    config.bbar = ['-'];

    var columns = [{
        header      : _('formalicious.field.value.label_name'),
        dataIndex   : 'name'
    }, {
        header      : _('formalicious.field.value.label_published'),
        dataIndex   : 'published',
        sortable    : true,
        editable    : false,
        width       : 125,
        fixed       : true,
        renderer    : this.renderBoolean,
        editor      : {
            xtype       : 'modx-combo-boolean'
        }
    }];

    Ext.applyIf(config, {
        columns     : columns,
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\GetList',
            field_id    : config.field_id,
            limit       : 0
        },
        autosave    : true,
        save_action : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\UpdateFromGrid',
        fields      : ['id', 'field_id', 'name', 'rank', 'published', 'selected'],
        pageSize    : 0,
        remoteSort  : true,
        enableDragDrop : true,
        ddGroup     : 'formalicious-grid-field-values-' + config.field_id,
        listeners   : {
            'afterrender' : {
                fn          : this.sortValues,
                scope       : this
            }
        },
        autoHeight  : true,
        maxHeight   : 300
    });

    Formalicious.grid.FieldValues.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.FieldValues, MODx.grid.Grid, {
    getMenu: function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.field.value.update'),
            handler : this.updateValue,
            scope   : this
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('formalicious.field.value.remove'),
            handler : this.removeValue
        }];
    },
    sortValues: function() {
        new Ext.dd.DropTarget(this.getView().mainBody, {
            ddGroup     : this.config.ddGroup,
            notifyDrop  : function(dd, e, data) {
                var grid    = data.grid,
                    sels    = grid.getSelectionModel().getSelections(),
                    items   = grid.getStore().data.items,
                    index   = dd.getDragData(e).rowIndex;

                if (undefined !== index) {
                    if (grid.getSelectionModel().hasSelection()) {
                        for (i = 0; i < sels.length; i++) {
                            grid.getStore().remove(grid.getStore().getById(sels[i].id));
                            grid.getStore().insert(index, sels[i]);
                        }

                        grid.getSelectionModel().selectRecords(sels);
                    }

                    var order = [];

                    Ext.each(items, (function(record) {
                        order.push(record.id);
                    }).bind(this));

                    MODx.Ajax.request({
                        url     : Formalicious.config.connector_url,
                        params  : {
                            action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\Sort',
                            order   : order.join(',')
                        },
                        listeners   : {
                            'success'   : {
                                fn          : function() {
                                    grid.getSelectionModel().clearSelections(true);
                                },
                                scope       : this
                            }
                        }
                    });
                }
            }
        });
    },
    createValue: function(btn, e) {
        if (this.createFieldValueWindow) {
            this.createFieldValueWindow.destroy();
        }

        this.createFieldValueWindow = MODx.load({
            xtype       : 'formalicious-window-field-value-create',
            closeAction : 'close',
            record      : {
                field_id    : this.config.field_id
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.createFieldValueWindow.setValues({
            field_id : this.config.field_id
        });
        this.createFieldValueWindow.show(e.target);
    },
    updateValue: function(btn, e) {
        if (this.updateFieldValueWindow) {
            this.updateFieldValueWindow.destroy();
        }

        this.updateFieldValueWindow = MODx.load({
            xtype       : 'formalicious-window-field-value-update',
            closeAction : 'close',
            record      : this.menu.record,
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateFieldValueWindow.setValues(this.menu.record);
        this.updateFieldValueWindow.show(e.target);
    },
    removeValue: function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.field.value.remove'),
            text    : _('formalicious.field.value.remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\Remove',
                id      : this.menu.record.id
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    },
    renderBoolean: function(d, c) {
        c.css = 1 === parseInt(d) || d ? 'green' : 'red';

        return 1 === parseInt(d) || d ? _('yes') : _('no');
    }
});

Ext.reg('formalicious-grid-field-values', Formalicious.grid.FieldValues);

Formalicious.window.FieldCreateValue = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.field.value.create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\Create'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'field_id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.field.value.label_name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.value.label_selected'),
            name        : 'selected',
            inputValue  : 1
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.value.label_published'),
            name        : 'published',
            inputValue  : 1
        }]
    });

    Formalicious.window.FieldCreateValue.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.FieldCreateValue, MODx.Window);

Ext.reg('formalicious-window-field-value-create', Formalicious.window.FieldCreateValue);

Formalicious.window.FieldUpdateValue = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.field.value.update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Answers\\Update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'hidden',
            name        : 'field_id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.field.value.label_name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.value.label_selected'),
            name        : 'selected',
            inputValue  : 1
        }, {
            xtype       : 'xcheckbox',
            boxLabel    : _('formalicious.field.value.label_published'),
            name        : 'published',
            inputValue  : 1
        }]
    });

    Formalicious.window.FieldUpdateValue.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.FieldUpdateValue, MODx.Window);

Ext.reg('formalicious-window-field-value-update', Formalicious.window.FieldUpdateValue);

Formalicious.combo.FieldType = function(config) {
    config = config || {};

    var items = [];

    Ext.each(Formalicious.config.fieldtypes, (function(type, index) {
        items.push([type.id, type.name, type.values, type.fields]);
    }).bind(this));

    Ext.applyIf(config, {
        store       : new Ext.data.SimpleStore({
            data        : items,
            fields      : ['id', 'name', 'values', 'fields']
        }),
        mode        : 'local',
        fields      : ['id', 'name', 'values', 'fields'],
        hiddenName  : 'type',
        valueField  : 'id',
        displayField : 'name'
    });

    Formalicious.combo.FieldType.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.combo.FieldType, MODx.combo.ComboBox);

Ext.reg('formalicious-combo-fieldtype', Formalicious.combo.FieldType);

Formalicious.combo.Heading = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        store       : new Ext.data.SimpleStore({
            data        : [
                ['h1', 'h1'],
                ['h2', 'h2'],
                ['h3', 'h3'],
                ['h4', 'h4'],
                ['h5', 'h5'],
                ['h6', 'h6']
            ],
            fields  : ['type', 'heading']
        }),
        mode        : 'local',
        fields      : ['type', 'heading'],
        hiddenName  : 'property',
        valueField  : 'type',
        displayField : 'heading',
        value       : 'h1'
    });

    Formalicious.combo.Heading.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.combo.Heading, MODx.combo.ComboBox);

Ext.reg('formalicious-combo-heading', Formalicious.combo.Heading);
