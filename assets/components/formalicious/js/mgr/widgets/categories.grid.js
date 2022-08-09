Formalicious.grid.Categories = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('formalicious.categories.create'),
        cls         : 'primary-button',
        handler     : this.createCategory,
        scope       : this
    }];

    var columns = [{
        header      : _('formalicious.categories.label_name'),
        dataIndex   : 'name',
        sortable    : true,
        editable    : false,
        width       : 200,
        fixed       : true
    }, {
        header      : _('formalicious.categories.label_description'),
        dataIndex   : 'description',
        sortable    : true,
        editable    : false,
        width       : 250
    }, {
        header      : _('formalicious.categories.label_published'),
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
        id          : 'formalicious-grid-categories',
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Categories\\GetList'
        },
        autosave    : true,
        save_action : '\\Sterc\\Formalicious\\Processors\\Mgr\\Categories\\UpdateFromGrid',
        fields      : ['id', 'name', 'description', 'published'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
    });

    Formalicious.grid.Categories.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.grid.Categories, MODx.grid.Grid, {
    getMenu : function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.categories.update'),
            handler : this.updateCategory
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('formalicious.categories.remove'),
            handler : this.removeCategory
        }];
    },
    createCategory :  function(btn, e) {
        if (this.createCategoryWindow) {
            this.createCategoryWindow.destroy();
        }

        this.createCategoryWindow = MODx.load({
            xtype       : 'formalicious-window-category-create',
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.createCategoryWindow.show(e.target);
    },
    updateCategory : function(btn, e) {
        if (this.updateCategoryWindow) {
            this.updateCategoryWindow.destroy();
        }

        this.updateCategoryWindow = MODx.load({
            xtype       : 'formalicious-window-category-update',
            record      : this.menu.record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateCategoryWindow.setValues(this.menu.record);
        this.updateCategoryWindow.show(e.target);
    },
    removeCategory : function(btn, e) {
        MODx.msg.confirm({
            title   : _('formalicious.categories.remove'),
            text    : _('formalicious.categories.remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : '\\Sterc\\Formalicious\\Processors\\Mgr\\Categories\\Remove',
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

Ext.reg('formalicious-grid-categories', Formalicious.grid.Categories);

Formalicious.window.CreateCategory = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('formalicious.categories.create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Categories\\Create'
        },
        fields      : [{
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.categories.label_name'),
            description : MODx.expandHelp ? '' : _('formalicious.categories.label_name_desc'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.categories.label_name_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('formalicious.categories.label_description'),
            description : MODx.expandHelp ? '' : _('formalicious.categories.label_description_desc'),
            name        : 'description',
            anchor      : '100%'
        }, {
            xtype       : 'label',
            text        : _('formalicious.categories.label_description_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkbox',
            hideLabel   : true,
            boxLabel    : _('formalicious.categories.label_published'),
            name        : 'published',
            inputValue  : 1
        }]
    });

    Formalicious.window.CreateCategory.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.CreateCategory, MODx.Window);

Ext.reg('formalicious-window-category-create', Formalicious.window.CreateCategory);

Formalicious.window.UpdateCategory = function(config) {
    config = config || {};

    Ext.applyIf(config,{
        autoHeight  : true,
        title       : _('formalicious.categories.update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : '\\Sterc\\Formalicious\\Processors\\Mgr\\Categories\\Update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.categories.label_name'),
            description : MODx.expandHelp ? '' : _('formalicious.categories.label_name_desc'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.categories.label_name_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('formalicious.categories.label_description'),
            description : MODx.expandHelp ? '' : _('formalicious.categories.label_description_desc'),
            name        : 'description',
            anchor      : '100%'
        }, {
            xtype       : 'label',
            text        : _('formalicious.categories.label_description_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'checkbox',
            hideLabel   : true,
            boxLabel    : _('formalicious.categories.label_published'),
            name        : 'published',
            inputValue  : 1
        }]
    });

    Formalicious.window.UpdateCategory.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.UpdateCategory, MODx.Window);

Ext.reg('formalicious-window-category-update', Formalicious.window.UpdateCategory);