
Formalicious.grid.FieldTypes = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formalicious-grid-fieldtypes'
        ,url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/fieldtype/getlist'
        }
        ,autosave: true
        ,fields: ['id','name','tpl','answertpl', 'values', 'validation', 'icon']
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
            ,editor: { xtype: 'textfield' }
        }]
        ,tbar: [{
            text: _('formalicious.fieldtype_create')
            ,handler: this.createFieldType
            ,scope: this
        }]
    });
    Formalicious.grid.FieldTypes.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.FieldTypes,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('formalicious.fieldtype_update')
            ,handler: this.updateFieldType
        });
        m.push('-');
        m.push({
            text: _('formalicious.fieldtype_remove')
            ,handler: this.removeFieldType
        });
        this.addContextMenuItem(m);
    }

    ,createFieldType: function(btn,e) {
        this.createUpdateFieldType(btn, e, false);
    }

    ,updateFieldType: function(btn,e) {
        this.createUpdateFieldType(btn, e, true);
    }

    ,createUpdateFieldType: function(btn,e,isUpdate) {
        var r;

        if(isUpdate){
            if (!this.menu.record || !this.menu.record.id) return false;
            r = this.menu.record;
        }else{
            r = {};
        }

        this.windows.createUpdateFieldType = MODx.load({
            xtype: 'formalicious-window-fieldtype-create-update'
            ,isUpdate: isUpdate
            ,title: (isUpdate) ?  _('formalicious.fieldtype_update') : _('formalicious.fieldtype_create')
            ,record: r
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.createUpdateFieldType.fp.getForm().reset();
        this.windows.createUpdateFieldType.fp.getForm().setValues(r);
        this.windows.createUpdateFieldType.show(e.target);
    }

    ,removeFieldType: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formalicious.fieldtype_remove')
            ,text: _('formalicious.fieldtype_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/fieldtype/remove'
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
Ext.reg('formalicious-grid-fieldtypes',Formalicious.grid.FieldTypes);

Formalicious.window.CreateUpdateFieldType = function(config) {
    config = config || {};
    this.ident = config.ident || 'formalicious-mecitem'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident
        ,height: 450
        ,width: 475
        ,modal: true
        ,closeAction: 'close'
        ,url: Formalicious.config.connectorUrl
        ,action: (config.isUpdate)? 'mgr/fieldtype/update' : 'mgr/fieldtype/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,id: this.ident+'-id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('formalicious.fieldtype.name')
            ,name: 'name'
            ,id: this.ident+'-name'
            ,anchor: '100%'
            ,allowBlank: false
        },{
            xtype: 'textfield'
            ,fieldLabel: _('formalicious.fieldtype.tpl')
            ,name: 'tpl'
            ,id: this.ident+'-tpl'
            ,anchor: '100%'
            ,allowBlank: false
        },{
            xtype: 'checkbox'
            ,fieldLabel: _('formalicious.fieldtype.values')
            ,boxLabel: _('yes')
            ,name: 'values'
            ,id: this.ident+'-values'
            ,anchor: '100%'
            ,inputValue: 1
            ,uncheckedValue: 0
        },{
            xtype: 'textfield'
            ,fieldLabel: _('formalicious.fieldtype.answertpl')
            ,name: 'answertpl'
            ,id: this.ident+'-answertpl'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('formalicious.fieldtype.validation')
            ,name: 'validation'
            ,id: this.ident+'-validation'
            ,anchor: '100%'
        },{
            xtype: 'modx-combo-browser'
            ,name: 'icon'
            ,hiddenName: 'icon'
            ,fieldLabel: _('formalicious.fieldtype.icon')
            ,rootId: Formalicious.config.assetsUrl+'img/types/'
            ,openTo: Formalicious.config.assetsUrl+'img/types/'
            ,source: 1
        }]
    });
    Formalicious.window.CreateUpdateFieldType.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.window.CreateUpdateFieldType,MODx.Window);
Ext.reg('formalicious-window-fieldtype-create-update',Formalicious.window.CreateUpdateFieldType);

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