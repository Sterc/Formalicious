
Formalicious.grid.Categories = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formalicious-grid-categories'
        ,url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/category/getlist'
        }
        ,autosave: true
        ,fields: ['id','name','description']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        },{
            header: _('name')
            ,dataIndex: 'name'
            ,width: 200
        },{
            header: _('description')
            ,dataIndex: 'description'
            ,width: 250
        }]
        ,tbar: [{
            text: _('formalicious.category_create')
            ,handler: this.createCategory
            ,scope: this
        }]
    });
    Formalicious.grid.Categories.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.Categories,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('formalicious.category_update')
            ,handler: this.updateCategory
        });
        m.push('-');
        m.push({
            text: _('formalicious.category_remove')
            ,handler: this.removeCategory
        });
        this.addContextMenuItem(m);
    }

    ,createCategory: function(btn,e) {
        this.createUpdateCategory(btn, e, false);
    }

    ,updateCategory: function(btn,e) {
        this.createUpdateCategory(btn, e, true);
    }

    ,createUpdateCategory: function(btn,e,isUpdate) {
        var r;

        if(isUpdate){
            if (!this.menu.record || !this.menu.record.id) return false;
            r = this.menu.record;
        }else{
            r = {};
        }

        this.windows.createUpdateCategory = MODx.load({
            xtype: 'formalicious-window-category-create-update'
            ,isUpdate: isUpdate
            ,title: (isUpdate) ?  _('formalicious.category_update') : _('formalicious.category_create')
            ,record: r
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.createUpdateCategory.fp.getForm().reset();
        this.windows.createUpdateCategory.fp.getForm().setValues(r);
        this.windows.createUpdateCategory.show(e.target);
    }

    ,removeCategory: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formalicious.category_remove')
            ,text: _('formalicious.category_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/category/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }

    ,getDragDropText: function(){
        return this.selModel.selections.items[0].data.name;
    }
});
Ext.reg('formalicious-grid-categories',Formalicious.grid.Categories);

Formalicious.window.CreateUpdateCategory = function(config) {
    config = config || {};
    this.ident = config.ident || 'formalicious-mecitem'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident
        ,autoHeight:true
        ,width: 475
        ,modal: true
        ,closeAction: 'close'
        ,url: Formalicious.config.connectorUrl
        ,action: (config.isUpdate)? 'mgr/category/update' : 'mgr/category/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,id: this.ident+'-id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('name')
            ,name: 'name'
            ,id: this.ident+'-name'
            ,anchor: '100%'
            ,allowBlank: false
        },{
            xtype: 'textarea'
            ,fieldLabel: _('description')
            ,name: 'description'
            ,id: this.ident+'-description'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,name: 'position'
            ,id: this.ident+'-position'
            ,hidden: true
        }]
    });
    Formalicious.window.CreateUpdateCategory.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.window.CreateUpdateCategory,MODx.Window);
Ext.reg('formalicious-window-category-create-update',Formalicious.window.CreateUpdateCategory);

