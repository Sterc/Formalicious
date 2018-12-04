Formalicious.grid.Categories = function(config) {
    config = config || {};

    config.tbar = [{
        text    : _('formalicious.category_create'),
        cls     : 'primary-button',
        handler : this.createCategory,
        scope   : this
    }];

    var columns = [{
        header      : _('name'),
        dataIndex   : 'name',
        width       : 200,
        fixed       : true
    }, {
        header      : _('description'),
        dataIndex   : 'description',
        width       : 250
    }];

    Ext.applyIf(config, {
        columns     : columns,
        id          : 'formalicious-grid-categories',
        url         : Formalicious.config.connectorUrl,
        baseParams  : {
            action      : 'mgr/category/getlist'
        },
        autosave    : true,
        fields      : ['id','name','description'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        remoteSort  : true
    });

    Formalicious.grid.Categories.superclass.constructor.call(this, config);
};
Ext.extend(Formalicious.grid.Categories,MODx.grid.Grid,{
    getMenu : function() {
        return [{
            text    : _('formalicious.category_update'),
            handler : this.updateCategory
        }, '-', {
            text    : _('formalicious.category_remove'),
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
            title   : _('formalicious.category_remove'),
            text    : _('formalicious.category_remove_confirm'),
            url     : this.config.url,
            params  : {
                action  : 'mgr/category/remove',
                id      : this.menu.record.id
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    }
});

Ext.reg('formalicious-grid-categories', Formalicious.grid.Categories);

Formalicious.window.CreateCategory = function(config) {
    config = config || {};

    Ext.applyIf(config,{
        autoHeight  : true,
        title       : _('formalicious.category_create'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/category/create'
        },
        fields      : [{
            xtype       : 'textfield',
            fieldLabel  : _('name'),
            name        : 'name',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('description'),
            name        : 'description',
            anchor      : '100%'
        }, {
            xtype       : 'hidden',
            name        : 'position'
        }]
    });

    Formalicious.window.CreateCategory.superclass.constructor.call(this,config);
};

Ext.extend(Formalicious.window.CreateCategory, MODx.Window);

Ext.reg('formalicious-window-category-create', Formalicious.window.CreateCategory);

Formalicious.window.UpdateCategory = function(config) {
    config = config || {};

    Ext.applyIf(config,{
        autoHeight  : true,
        title       : _('formalicious.category_update'),
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/category/update'
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
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('description'),
            name        : 'description',
            anchor      : '100%'
        }, {
            xtype       : 'hidden',
            name        : 'position'
        }]
    });

    Formalicious.window.UpdateCategory.superclass.constructor.call(this,config);
};

Ext.extend(Formalicious.window.UpdateCategory, MODx.Window);

Ext.reg('formalicious-window-category-update', Formalicious.window.UpdateCategory);