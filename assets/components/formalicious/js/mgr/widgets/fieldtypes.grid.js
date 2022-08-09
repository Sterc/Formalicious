Formalicious.grid.FieldTypes = function(config) {
    config = config || {};

    config.tbar = [{
        text    : _('formalicious.fieldtypes.create'),
        cls     : 'primary-button',
        handler : this.createFieldType,
        scope   : this
    }];

    var columns = [{
        header      : _('formalicious.fieldtypes.label_name'),
        dataIndex   : 'name',
        sortable    : true,
        editable    : false,
        width       : 200
    }, {
        header      : _('formalicious.fieldtypes.label_validation'),
        dataIndex   : 'validation',
        sortable    : true,
        editable    : false,
        width       : 275,
        fixed       : true
    }, {
        header      : _('formalicious.fieldtypes.label_values'),
        dataIndex   : 'values',
        sortable    : true,
        editable    : false,
        width       : 200,
        fixed       : true,
        renderer    : this.renderBoolean
    }];

    Ext.applyIf(config, {
        columns     : columns,
        id          : 'formalicious-grid-fieldtypes',
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\GetList'
        },
        autosave    : true,
        save_action : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\UpdateFromGrid',
        fields      : ['id', 'name', 'tpl', 'answertpl', 'values', 'validation', 'icon', 'fields'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
    });

    Formalicious.grid.FieldTypes.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.FieldTypes, MODx.grid.Grid,{
    getMenu : function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.fieldtypes.update'),
            handler : this.updateFieldType
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-copy"></i>' + _('formalicious.fieldtypes.duplicate'),
            handler : this.duplicateFieldType
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('formalicious.fieldtypes.remove'),
            handler : this.removeFieldType
        }];
    },
    createFieldType : function(btn, e) {
        if (this.createFieldTypeWindow) {
            this.createFieldTypeWindow.destroy();
        }

        this.createFieldTypeWindow = MODx.load({
            xtype       : 'formalicious-window-fieldtype-create',
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.createFieldTypeWindow.show(e.target);
    },
    updateFieldType: function(btn,e) {
        if (this.updateFieldTypeWindow) {
            this.updateFieldTypeWindow.destroy();
        }

        this.updateFieldTypeWindow = MODx.load({
            xtype       : 'formalicious-window-fieldtype-update',
            record      : this.menu.record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateFieldTypeWindow.setValues(this.menu.record);
        this.updateFieldTypeWindow.show(e.target);
    },
    duplicateFieldType : function(btn, e) {
        if (this.duplicateFieldTypeWindow) {
            this.duplicateFieldTypeWindow.destroy();
        }

        var record = Ext.apply({}, {
            name : _('duplicate_of', {
                name : this.menu.record.name
            })
        }, this.menu.record);

        this.duplicateFieldTypeWindow = MODx.load({
            xtype       : 'formalicious-window-fieldtype-duplicate',
            record      : record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.duplicateFieldTypeWindow.setValues(record);
        this.duplicateFieldTypeWindow.show(e.target);
    },
    removeFieldType : function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.fieldtypes.remove'),
            text    : _('formalicious.fieldtypes.remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\Remove',
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

Ext.reg('formalicious-grid-fieldtypes', Formalicious.grid.FieldTypes);

Formalicious.window.CreateFieldType = function(config) {
    config = config || {};

    Ext.applyIf(config,{
        autoHeight  : true,
        title       : _('formalicious.fieldtypes.create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\Create'
        },
        fields      : [{
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_name'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_name_desc'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_name_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_tpl'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_tpl_desc'),
            name        : 'tpl',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_tpl_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkboxgroup',
            fieldLabel  : _('formalicious.fieldtypes.label_fields'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_fields_desc'),
            columns     : 2,
            items       : [{
                boxLabel    : _('formalicious.field.label_title'),
                name        : 'fields[]',
                inputValue  : 'title',
                checked     : true,
                disabled    : true
            }, {
                boxLabel    : _('formalicious.field.label_description'),
                name        : 'fields[]',
                inputValue  : 'description',
                checked     : true,
                disabled    : true
            }, {
                boxLabel    : _('formalicious.field.label_placeholder'),
                name        : 'fields[]',
                inputValue  : 'placeholder'
            }, {
                boxLabel    : _('formalicious.field.label_property'),
                name        : 'fields[]',
                inputValue  : 'property'
            }, {
                boxLabel    : _('formalicious.field.label_required'),
                name        : 'fields[]',
                inputValue  : 'required'
            }, {
                boxLabel    : _('formalicious.field.label_published'),
                name        : 'fields[]',
                inputValue  : 'published',
                checked     : true,
                disabled    : true
            }]
        }, {
            xtype       : 'checkbox',
            fieldLabel  : _('formalicious.fieldtypes.label_values'),
            boxLabel    : _('formalicious.fieldtypes.label_values_desc'),
            name        : 'values',
            anchor      : '100%',
            inputValue  : 1,
            uncheckedValue : 0,
            listeners   : {
                'check'     : {
                    fn          : this.onUpdateValues,
                    scope       : this
                },
                'afterrender' : {
                    fn          : this.onUpdateValues,
                    scope       : this
                }
            }
        }, {
            hidden      : true,
            id          : 'formalicious-window-fieldtype-create-values',
            layout      : 'form',
            labelSeparator : '',
            items       : [{
                xtype       : 'textfield',
                fieldLabel  : _('formalicious.fieldtypes.label_answertpl'),
                description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_answertpl_desc'),
                name        : 'answertpl',
                anchor      : '100%'
            }, {
                xtype       : 'label',
                html        : _('formalicious.fieldtypes.label_answertpl_desc'),
                cls         : 'desc-under'
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_validation'),
            name        : 'validation',
            anchor      : '100%'
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_validation_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.CreateFieldType.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.CreateFieldType, MODx.Window, {
    onUpdateValues : function(tf) {
        if (tf.getValue()) {
            Ext.getCmp('formalicious-window-fieldtype-create-values').show();
        } else {
            Ext.getCmp('formalicious-window-fieldtype-create-values').hide();
        }
    }
});

Ext.reg('formalicious-window-fieldtype-create', Formalicious.window.CreateFieldType);

Formalicious.window.UpdateFieldType = function(config) {
    config = config || {};

    Ext.applyIf(config,{
        autoHeight  : true,
        title       : _('formalicious.fieldtypes.update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\Update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_name'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_name_desc'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_name_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_tpl'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_tpl_desc'),
            name        : 'tpl',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_tpl_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkboxgroup',
            fieldLabel  : _('formalicious.fieldtypes.label_fields'),
            description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_fields_desc'),
            columns     : 2,
            items       : [{
                boxLabel    : _('formalicious.field.label_title'),
                name        : 'fields[]',
                inputValue  : 'title',
                checked     : true,
                disabled    : true
            }, {
                boxLabel    : _('formalicious.field.label_description'),
                name        : 'fields[]',
                inputValue  : 'description',
                checked     : true,
                disabled    : true
            }, {
                boxLabel    : _('formalicious.field.label_placeholder'),
                name        : 'fields[]',
                inputValue  : 'placeholder',
                checked     : -1 !== config.record.fields.indexOf('placeholder')
            }, {
                boxLabel    : _('formalicious.field.label_property'),
                name        : 'fields[]',
                inputValue  : 'property',
                checked     : -1 !== config.record.fields.indexOf('property')
            }, {
                boxLabel    : _('formalicious.field.label_required'),
                name        : 'fields[]',
                inputValue  : 'required',
                checked     : -1 !== config.record.fields.indexOf('required')
            }, {
                boxLabel    : _('formalicious.field.label_published'),
                name        : 'fields[]',
                inputValue  : 'published',
                checked     : true,
                disabled    : true
            }]
        }, {
            xtype       : 'checkbox',
            fieldLabel  : _('formalicious.fieldtypes.label_values'),
            boxLabel    : _('formalicious.fieldtypes.label_values_desc'),
            name        : 'values',
            anchor      : '100%',
            inputValue  : 1,
            uncheckedValue : 0,
            listeners   : {
                'check'     : {
                    fn          : this.onUpdateValues,
                    scope       : this
                },
                'afterrender' : {
                    fn          : this.onUpdateValues,
                    scope       : this
                }
            }
        }, {
            hidden      : true,
            id          : 'formalicious-window-fieldtype-update-values',
            layout      : 'form',
            labelSeparator : '',
            items       : [{
                xtype       : 'textfield',
                fieldLabel  : _('formalicious.fieldtypes.label_answertpl'),
                description : MODx.expandHelp ? '' : _('formalicious.fieldtypes.label_answertpl_desc'),
                name        : 'answertpl',
                anchor      : '100%'
            }, {
                xtype       : 'label',
                html        : _('formalicious.fieldtypes.label_answertpl_desc'),
                cls         : 'desc-under'
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_validation'),
            name        : 'validation',
            anchor      : '100%'
        }, {
            xtype       : 'label',
            html        : _('formalicious.fieldtypes.label_validation_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.UpdateFieldType.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.UpdateFieldType, MODx.Window, {
    onUpdateValues : function(tf) {
        if (tf.getValue()) {
            Ext.getCmp('formalicious-window-fieldtype-update-values').show();
        } else {
            Ext.getCmp('formalicious-window-fieldtype-update-values').hide();
        }
    }
});

Ext.reg('formalicious-window-fieldtype-update', Formalicious.window.UpdateFieldType);

Formalicious.window.DuplicateFieldType = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.fieldtypes.duplicate'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\FieldTypes\\Duplicate'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtypes.label_name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }]
    });

    Formalicious.window.DuplicateFieldType.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.DuplicateFieldType, MODx.Window);

Ext.reg('formalicious-window-fieldtype-duplicate', Formalicious.window.DuplicateFieldType);