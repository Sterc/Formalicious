Formalicious.grid.FieldTypes = function(config) {
    config = config || {};

    config.tbar = [{
        text    : _('formalicious.fieldtype_create'),
        cls     : 'primary-button',
        handler : this.createFieldType,
        scope   : this
    }];

    var columns = [{
        header      : _('name'),
        dataIndex   : 'name',
        width       : 200
    }, {
        header      : _('formalicious.fieldtype.validation'),
        dataIndex   : 'validation',
        width       : 275,
        fixed       : true
    }, {
        header      : _('formalicious.fieldtype.values'),
        dataIndex   : 'values',
        width       : 200,
        fixed       : true,
        renderer    : this.renderBoolean
    }];

    Ext.applyIf(config, {
        columns     : columns,
        id          : 'formalicious-grid-fieldtypes',
        url         : Formalicious.config.connectorUrl,
        baseParams  : {
            action      : 'mgr/fieldtype/getlist'
        },
        autosave    : true,
        fields      : ['id','name','tpl','answertpl', 'values', 'validation', 'icon'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
    });

    Formalicious.grid.FieldTypes.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.FieldTypes, MODx.grid.Grid,{
    getMenu : function() {
        return [{
            text    : _('formalicious.fieldtype_update'),
            handler : this.updateFieldType
        }, '-', {
            text    : _('formalicious.fieldtype_remove'),
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
    removeFieldType : function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.fieldtype_remove'),
            text    : _('formalicious.fieldtype_remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : 'mgr/fieldtype/remove',
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
        title       : _('formalicious.fieldtype_create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/fieldtype/create'
        },
        fields      : [{
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.tpl'),
            name        : 'tpl',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.tpl.description'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkbox',
            fieldLabel  : _('formalicious.fieldtype.values'),
            boxLabel    : _('yes'),
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
                fieldLabel  : _('formalicious.fieldtype.answertpl'),
                name        : 'answertpl',
                anchor      : '100%'
            }, {
                xtype       : MODx.expandHelp ? 'label' : 'hidden',
                html        : _('formalicious.fieldtype.answertpl.description'),
                cls         : 'desc-under'
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.validation'),
            name        : 'validation',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.validation.description'),
            cls         : 'desc-under'
        }/*, {
            xtype       : 'modx-combo-browser',
            fieldLabel  : _('formalicious.fieldtype.icon'),
            name        : 'icon',
            rootId      : Formalicious.config.assetsUrl + 'img/types/',
            openTo      : Formalicious.config.assetsUrl + 'img/types/',
            source      : MODx.config['default_media_source']
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.icon.description'),
            cls         : 'desc-under'
        }*/]
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
        title       : _('formalicious.fieldtype_update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/fieldtype/update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.tpl'),
            name        : 'tpl',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.tpl.description'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkbox',
            fieldLabel  : _('formalicious.fieldtype.values'),
            boxLabel    : _('yes'),
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
                fieldLabel  : _('formalicious.fieldtype.answertpl'),
                name        : 'answertpl',
                anchor      : '100%'
            }, {
                xtype       : MODx.expandHelp ? 'label' : 'hidden',
                html        : _('formalicious.fieldtype.answertpl.description'),
                cls         : 'desc-under'
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.fieldtype.validation'),
            name        : 'validation',
            anchor      : '100%'
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.validation.description'),
            cls         : 'desc-under'
        }/*, {
            xtype       : 'modx-combo-browser',
            fieldLabel  : _('formalicious.fieldtype.icon'),
            name        : 'icon',
            rootId      : Formalicious.config.assetsUrl + 'img/types/',
            openTo      : Formalicious.config.assetsUrl + 'img/types/',
            source      : MODx.config['default_media_source']
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('formalicious.fieldtype.icon.description'),
            cls         : 'desc-under'
        }*/]
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

/*&
Formalicious.combo.FieldTypes = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.SimpleStore({
            fields: ['d','v']
            ,data: [
                [_('formalicious.fieldtype.textfield'),'text'],
                [_('formalicious.fieldtype.textarea'),'textarea'],
                [_('formalicious.fieldtype.checkbox'),'checkbox'],
                [_('formalicious.fieldtype.'),''],
                [_('formalicious.fieldtype.'),''],
                [_('formalicious.fieldtype.'),''],
                [_('formalicious.fieldtype.'),''],
                [_('formalicious.fieldtype.'),''],
            ]
        })
        ,displayField: 'd'
        ,valueField: 'v'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    Formalicious.combo.FieldTypes.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.combo.FieldTypes,MODx.combo.ComboBox);
Ext.reg('formalicious-combo-fieldtypes',Formalicious.combo.FieldTypes);*/