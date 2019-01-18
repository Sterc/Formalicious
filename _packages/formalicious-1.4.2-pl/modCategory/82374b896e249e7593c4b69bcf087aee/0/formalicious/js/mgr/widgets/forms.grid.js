Formalicious.grid.Forms = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('formalicious.form_create'),
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
        width       : 50,
        fixed       : true
    }, {
        header      : _('formalicious.name'),
        dataIndex   : 'name'
    }, {
        header      : _('formalicious.emailto'),
        dataIndex   : 'emailto',
        width       : 250,
        fixed       : true
    }, {
        header      : _('published'),
        dataIndex   : 'published',
        width       : 125,
        fixed       : true,
        renderer    : this.renderBoolean
    }, {
        header      : _('formalicious.actions'),
        width       : 125,
        fixed       : true,
        renderer    : this.renderActions
    }];

    Ext.applyIf(config, {
        columns     : columns,
        url         : Formalicious.config.connectorUrl,
        baseParams  : {
            action      : 'mgr/form/getlist',
            category    : config.category
        },
        autosave    : true,
        save_action : 'mgr/form/updatefromgrid',
        fields      : ['id','name','emailto', 'published'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
        /*,viewConfig: {
            forceFit:true
            ,enableRowBody:true
            ,scrollOffset: 0
            ,autoFill: true
            ,showPreview: true
            ,getRowClass : function(rec){
                return rec.data.published ? 'grid-row-active' : 'grid-row-inactive';
            }
        }*/
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
            text    : _('update'),
            handler : this.updateForm
        }, '-', {
            text    : _('duplicate'),
            handler : this.duplicateForm
        }, '-', {
            text    : _('delete'),
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
            title   : _('formalicious.form_remove'),
            text    : _('formalicious.form_remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : 'mgr/form/remove',
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
    renderActions: function(value, metaData, record, rowIndex, colIndex, store) {
        var tpl = new Ext.XTemplate('<tpl for=".">' + '<tpl if="actions !== null">' + '<ul class="icon-buttons">' + '<tpl for="actions">' + '<li><button type="button" class="controlBtn {className}" title="{title}">{text}</button></li>' + '</tpl>' + '</ul>' + '</tpl>' + '</tpl>', {
            compiled: true
        });
        var values = {};
        var h = [];
        h.push({
            className: "update formalicious-icon icon icon-pencil",
            text: "",
            title: _('update')
        });
        h.push({
            className: "duplicate formalicious-icon icon icon-clone",
            text: "",
            title: _('duplicate')
        });
        h.push({
            className: "delete formalicious-icon icon icon-times",
            text: "",
            title: _('remove')
        });
        values.actions = h;
        return tpl.apply(values);
    },
    renderEmails: function(d) {
        var tpl = new Ext.XTemplate('<tpl for=".">' +
            '<ul class="emailto">' +
                '<tpl for="emails">' +
                    '<li>{ email }</li>' +
                '</tpl>' +
            '</ul>' +
        '</tpl>', {
            compiled : true
        });

        var emails = [];

        d.split(',').forEach(function (email) {
            emails.push({
                email : email
            });
        });

        return tpl.apply({
            emails : emails
        });
    },
    renderBoolean: function(d, c) {
        c.css = 1 === parseInt(d) || d ? 'green' : 'red';

        return 1 === parseInt(d) || d ? _('yes') : _('no');
    }
    ,onClick: function(e) {

        var t = e.getTarget();
        var elm = t.className.split(' ')[0];
        if (elm == 'controlBtn') {
        var act = t.className.split(' ')[1];
        var record = this.getSelectionModel()
        .getSelected();
        this.menu.record = record.data;
        switch (act) {
            case 'update':
                this.updateForm(record, e);
            break;

            case 'duplicate':
                this.duplicateForm(record, e);
                break;

            case 'delete':
                this.removeForm(record, e);
            break;
            }
        }
    }
});

Ext.reg('formalicious-grid-forms', Formalicious.grid.Forms);

Formalicious.window.DuplicateForm = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.form_duplicate'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/form/duplicate'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }]
    });

    Formalicious.window.DuplicateForm.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.DuplicateForm, MODx.Window);

Ext.reg('formalicious-window-form-duplicate', Formalicious.window.DuplicateForm);