Formalicious.grid.Forms = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('formalicious.forms.create'),
        cls         : 'primary-button',
        handler     : this.createForm,
        scope       : this
    }, '->', {
        xtype       : 'textfield',
        name        : 'formalicious-filter-form-' + config.category + '-search',
        id          : 'formalicious-filter-form-' + config.category + '-search',
        emptyText   : _('search') + '...',
        listeners   : {
            'change'    : {
                fn          : this.filterSearch,
                scope       : this
            },
            'render'    : {
                fn          : function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        keys    : Ext.EventObject.ENTER,
                        fn      : this.blur,
                        scope   : cmp
                    });
                },
                scope       : this
            }
        }
    }, {
        xtype       : 'button',
        cls         : 'x-form-filter-clear',
        id          : 'formalicious-filter-forms-' + config.category + '-clear',
        text        : _('filter_clear'),
        listeners   : {
            'click'     : {
                fn          : this.clearFilter,
                scope       : this
            }
        }
    }];

    var columns = [{
        header      : _('id'),
        dataIndex   : 'id',
        sortable    : true,
        editable    : false,
        width       : 50,
        fixed       : true
    }, {
        header      : _('formalicious.settings.label_name'),
        dataIndex   : 'name',
        sortable    : true,
        editable    : false,
        width       : 200
    }, {
        header      : _('formalicious.settings.label_email'),
        dataIndex   : 'emailto',
        sortable    : true,
        editable    : false,
        width       : 175,
        fixed       : true,
        renderer    : this.renderEmailTo
    }, {
        header      : _('formalicious.settings.label_fiaremail'),
        dataIndex   : 'fiaremail',
        sortable    : true,
        editable    : false,
        width       : 175,
        fixed       : true,
        renderer    : this.renderBoolean
    }, {
        header      : _('formalicious.settings.label_saveform'),
        dataIndex   : 'name',
        sortable    : true,
        editable    : false,
        width       : 125,
        fixed       : true,
        renderer    : this.renderFormSave
    }, {
        header      : _('formalicious.settings.label_published'),
        dataIndex   : 'published',
        sortable    : true,
        editable    : false,
        width       : 125,
        fixed       : true,
        renderer    : this.renderBoolean
    }, {
        header      : _('actions'),
        sortable    : true,
        editable    : false,
        width       : 125,
        fixed       : true,
        renderer    : this.renderActions
    }];

    Ext.applyIf(config, {
        columns     : columns,
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\GetList',
            category    : config.category
        },
        fields      : ['id', 'name', 'email', 'emailto', 'fiaremail', 'published'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
    });

    Formalicious.grid.Forms.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.Forms, MODx.grid.Grid, {
    filterSearch : function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();

        this.getBottomToolbar().changePage(1);
    },
    clearFilter : function() {
        this.getStore().baseParams.query = '';

        Ext.getCmp('formalicious-filter-form-' + this.config.category + '-search').reset();

        this.getBottomToolbar().changePage(1);
    },
    getMenu : function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.forms.update'),
            handler : this.updateForm
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-copy"></i>' + _('formalicious.forms.duplicate'),
            handler : this.duplicateForm
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.forms.remove'),
            handler : this.removeForm
        }];
    },
    createForm : function(btn, e) {
        MODx.loadPage('update', 'category=' + this.category + '&namespace=' + MODx.request.namespace);
    },
    updateForm : function(btn, e) {
        MODx.loadPage('update', 'category=' + this.category + '&namespace=' + MODx.request.namespace + '&id=' + this.menu.record.id);
    },
    duplicateForm : function(btn, e) {
        if (this.duplicateFormWindow) {
            this.duplicateFormWindow.destroy();
        }

        var record = Ext.apply({}, {
            name : _('duplicate_of', {
                name : this.menu.record.name
            })
        }, this.menu.record);

        this.duplicateFormWindow = MODx.load({
            xtype       : 'formalicious-window-form-duplicate',
            record      : record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                     fn          : function (response) {
                         MODx.loadPage('update', 'category=' + this.config.category + '&namespace=' + MODx.request.namespace + '&id=' + response.a.result.object.id);
                     },
                     scope       : this
                }
            }
        });

        this.duplicateFormWindow.setValues(record);
        this.duplicateFormWindow.show(e.target);
    },
    removeForm : function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.forms.remove'),
            text    : _('formalicious.forms.remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\Remove',
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
    renderTitle: function(d, c, e) {
        return '<h3>' + d + ' (' + e.id + ')</h3>';
    },
    renderFormSave: function(d, c, e) {
        if (parseInt(e.json.saveform) === 1 || e.json.saveform) {
            var formItLink = Formalicious.config.formit_manager_link + '&form=' + encodeURIComponent(Formalicious.config.save_forms_prefix + ': ' + d);

            return String.format('<a href="{0}" title="{1}">{2}</a>', formItLink, _('formalicious.formit_view_form'), _('formalicious.formit_view_form'));
        }

        c.css = 'red';

        return _('no');
    },
    renderEmailTo: function(d, c, e) {
        if (parseInt(e.json.email) === 1 || e.json.email) {
            return d;
        }

        c.css = 'red';

        return _('no');
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
    onClick : function(e) {
        var btn = e.getTarget();
        var cls = btn.className.split(' ');
        var record = this.getSelectionModel().getSelected();

        if (record) {
            this.menu.record = record.data;

            if (-1 !== cls.indexOf('action-edit')) {
                this.updateForm(e.getTarget(), e);
            } else if (-1 !== cls.indexOf('action-duplicate')) {
                this.duplicateForm(e.getTarget(), e);
            } else if (-1 !== cls.indexOf('action-remove')) {
                this.removeForm(e.getTarget(), e);
            }
        }

        return false;
    }
});

Ext.reg('formalicious-grid-forms', Formalicious.grid.Forms);

Formalicious.window.DuplicateForm = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.forms.duplicate'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\Duplicate'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.settings.label_name'),
            description : MODx.expandHelp ? '' : _('formalicious.settings.label_name_desc'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }]
    });

    Formalicious.window.DuplicateForm.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.DuplicateForm, MODx.Window);

Ext.reg('formalicious-window-form-duplicate', Formalicious.window.DuplicateForm);