Formalicious.panel.Update = function(config) {
    config = config || {};
    Ext.apply(config,{
        url: Formalicious.config.connector_url
        ,baseParams: {
            action: (MODx.request.id) ? 'mgr/form/update' : 'mgr/form/new'
            ,id: MODx.request.id
        }
        ,border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,id: 'formalicious-panel-update'
        //,useLoadingMask: true
        ,listeners: {
            'setup': {fn:this.setup,scope:this}
            ,'success': {fn:this.success,scope:this}
            ,'beforeSubmit': {fn:this.beforeSubmit,scope:this}
        }
        ,items: [{
            html: '<h2>'+_('formalicious')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('formalicious.settings')
                ,items: [{
                    xtype: 'panel'
                    ,border: false
                    ,cls: 'container'
                    ,layout: 'form'
                    ,labelWidth: 150
                    ,defaults: {xtype: 'textfield',width: 400,msgTarget: 'under'}
                    ,items: [{
                        xtype: 'panel'
                        ,html: '<p>'+_('formalicious.settings.intro_msg')+'</p>'
                        ,border: false
                        ,bodyCssClass: 'panel-desc'
                        ,width: 'auto'
                    },{
                        xtype: 'hidden'
                        ,name: 'category_id'
                    },{
                        name: 'name'
                        ,fieldLabel: _('formalicious.field.name')
                        ,allowBlank: false
                        ,enableKeyEvents: true
                        ,listeners: {
                            'keyup': {
                                scope:this,fn:function(f,e) {
                                    var title = Ext.util.Format.stripTags(f.getValue());
                                    Ext.getCmp('modx-page-header').getEl().update('<h2>'+_('formalicious')+': '+title+'</h2>');
                                }
                            }
                        }
                    },{
                        xtype: 'textarea'
                        ,name: 'description'
                        ,fieldLabel: _('formalicious.field.text')
                    },{
                        name: 'emailto'
                        ,fieldLabel: _('formalicious.field.emailto')
                        ,regex: /^(([a-zA-Z0-9_\+\.\-]+)@([a-zA-Z0-9_.\-]+)\.([a-zA-Z]{2,5}){1,25})+([;,.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*$/
                    },{
                        name: 'subject'
                        ,fieldLabel: _('formalicious.field.subject')
                    },{
                        xtype: 'modx-combo'
                        ,name: 'redirectto'
                        ,hiddenName: 'redirectto'
                        ,fieldLabel: _('formalicious.field.redirectto')
                        ,displayField: 'pagetitle'
                        ,valueField: 'id'
                        ,mode: 'remote'
                        ,fields: ['id','pagetitle']
                        ,forceSelection: true
                        ,editable: true
                        ,typeAhead: true
                        ,enableKeyEvents: true
                        ,pageSize: 20
                        ,url: Formalicious.config.connector_url
                        ,baseParams: {
                            action: 'mgr/resource/getlist'
                        }
                    },{
                        xtype: 'checkbox'
                        ,name: 'saveform'
                        ,fieldLabel: _('formalicious.field.saveform')
                        ,inputValue: 1
                    },{
                        xtype: 'checkbox'
                        ,name: 'published'
                        ,fieldLabel: _('formalicious.field.published')
                        ,inputValue: 1
                    },/*{
                     xtype: 'textarea'
                     ,name: 'thnxcontent'
                     ,fieldLabel: _('formalicious.field.thnxcontent')
                     },*/{
                        xtype: 'panel'
                        ,html: '<p>'+_('formalicious.field.fiar_msg')+'</p>'
                        ,border: false
                        ,bodyCssClass: 'panel-desc'
                        ,width: 'auto'
                    },{
                        xtype: 'checkbox'
                        ,name: 'fiaremail'
                        ,fieldLabel: _('formalicious.field.fiaremail')
                        ,inputValue: 1
                    },{
                        xtype: 'modx-combo'
                        ,name: 'fiaremailto'
                        ,hiddenName: 'fiaremailto'
                        ,fieldLabel: _('formalicious.field.fiaremailto')
                        ,url: Formalicious.config.connector_url
                        ,baseParams: {
                            action: 'mgr/field/getlist'
                            ,form_id: (MODx.request.id) ? MODx.request.id : '-1'
                            ,limit: 0
                        }
                        ,fields: ['id','title']
                        ,displayField: 'title'
                        ,valueField: 'id'
                        ,listeners: {
                            beforequery: function(queryEv){
                                queryEv.combo.expand();
                                queryEv.combo.store.load();
                                return false;
                            }
                        }
                    },{
                        xtype: 'label'
                        ,text: _('formalicious.field.fiaremailto.description')
                        ,cls: 'desc-under'
                        ,style: 'margin: 5px 0 0 155px'
                        ,width: 500
                    },{
                        name: 'fiaremailfrom'
                        ,fieldLabel: _('formalicious.field.fiaremailfrom')
                        ,vtype: 'email'
                    },{
                        name: 'fiarsubject'
                        ,fieldLabel: _('formalicious.field.fiarsubject')
                    },{
                        xtype: 'textarea'
                        ,name: 'fiarcontent'
                        ,height: 175
                        ,fieldLabel: _('formalicious.field.fiarcontent')
                        ,style: 'font: normal 13px/1.4 "Helvetica Neue", Helvetica, Arial, Tahoma, sans-serif;'
                    },{
                        id: 'fiarattachment'
                        ,xtype: 'modx-combo-browser'
                        ,source: MODx.config['formalicious.source']
                        ,name: 'fiarattachment'
                        ,fieldLabel: _('formalicious.field.fiarattachment')
                        ,listeners: {
                            'select': {
                                fn:function(data) {
                                    console.log(data);
                                    Ext.getCmp('fiarattachment').setValue(data.fullRelativeUrl);
                                    Ext.getCmp('preview').setSrc(data.url, MODx.config['formalicious.source']);
                                }
                            }
                        }
                    }/* @todo tmp disabled ,{
                        id: 'preview'
                        ,name: 'preview'
                        ,fieldLabel: _('formalicious.field.preview')
                        ,xtype: 'image'
                        ,listeners: {
                            'afterrender': {
                                fn: function(data) {
                                    var newLabel = _('formalicious.field.preview') + ':';
                                    newLabel += '<br/><span class="desc-under">' + _('formalicious.field.preview.description') + '</span>';

                                    Ext.getCmp('preview').label.update(newLabel);
                                }
                            }
                        }
                    }*/]
                }]
            },{
                title: _('formalicious.fields')
                ,xtype: 'formalicious-panel-manage-form'
                ,disabled: (MODx.request.id) ? false : true
            },{
                title: _('formalicious.advanced')
                ,items: [{
                    xtype: 'panel'
                    ,border: false
                    ,cls: 'container'
                    ,layout: 'form'
                    ,labelWidth: 150
                    ,defaults: {xtype: 'textfield',msgTarget: 'under'}
                    ,items: [{
                        xtype: 'panel'
                        ,html: '<p>'+_('formalicious.advanced.intro_msg')+'</p>'
                        ,border: false
                        ,bodyCssClass: 'panel-desc'
                        ,width: 'auto'
                    },{
                        name: 'prehooks'
                        ,fieldLabel: _('formalicious.advanced.prehooks')
                        ,width: 500
                        ,allowBlank: true
                    },{
                        xtype: 'label'
                        ,text: _('formalicious.advanced.prehooks.description')
                        ,cls: 'desc-under'
                        ,style: 'margin: 5px 0 0 155px'
                        ,width: 500
                    },{
                        name: 'posthooks'
                        ,fieldLabel: _('formalicious.advanced.posthooks')
                        ,width: 500
                        ,allowBlank: true
                    },{
                        xtype: 'label'
                        ,text: _('formalicious.advanced.posthooks.description')
                        ,cls: 'desc-under'
                        ,style: 'margin: 5px 0 0 155px'
                        ,width: 500
                    },{
                        xtype: 'label'
                        ,fieldLabel: _('formalicious.advanced.parameters')
                        ,style: 'margin: 15px 0 0 0'
                    },{
                        xtype: 'label'
                        ,text: _('formalicious.advanced.parameters.description')
                        ,cls: 'desc-under'
                        ,style: 'margin: 0 0 15px 0'
                    },{
                        xtype: 'formalicious-grid-advanced-params'
                        ,id: 'formalicious-grid-advanced-params'
                    }]

                }]
            }]
        }]
    });

    Formalicious.panel.Update.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.panel.Update,MODx.FormPanel,{
    setup: function() {
        if(MODx.request.id){
            MODx.Ajax.request({
                url: Formalicious.config.connector_url
                ,params: {
                    action: 'mgr/form/get'
                    ,id: MODx.request.id
                }
                ,listeners: {
                    'success': {fn:function(r) {
                        // @todo Tmp disabled: Ext.getCmp('preview').setSrc(r.object.fiarattachment, MODx.config['formalicious.source']);
                        Ext.getCmp('modx-page-header').getEl().update('<h2>'+_('formalicious')+': '+r.object.name+'</h2>');
                        this.getForm().setValues(r.object);

                        /* Add the data from the parameters field to the parameters grid (advanced tab) */
                        var i = 0;
                        var grid = Ext.getCmp('formalicious-grid-advanced-params');
                        var store = grid.getStore();
                        store.removeAll(true);

                        /* Read the images json to object array */
                        var parameters = Ext.decode(r.object.parameters);
                        if (parameters.length > 0) {
                            parameters.forEach(function(value) {
                                var rec = new grid.Record({key: value.key, value: value.value});
                                store.insert(i,rec);
                            });
                        }

                        this.fireEvent('ready',r.object);
                        MODx.fireEvent('ready');
                    },scope:this}
                }
            });
        } else {
            //Dirty fix. Won't work inside baseParams
            var r = {
                category_id: MODx.request.category
            };
            this.getForm().setValues(r);
            this.fireEvent('ready',r);
            MODx.fireEvent('ready');
        }
    }
    ,success: function(o) {
        if(!MODx.request.id){
            MODx.loadPage('update', 'namespace='+MODx.request.namespace+'&id=' + o.result.object.id);
        }
    }
    ,beforeSubmit: function(o) {
        var paramStore = Ext.pluck(Ext.getCmp('formalicious-grid-advanced-params').getStore().data.items, 'data');
        var parameters = [];
        paramStore.forEach(function(e) {
            parameters.push(e);
        });
        if (parameters.length > 0) {
            parameters = Ext.encode(parameters);
        } else {
            parameters = '';
        }
        this.baseParams.parameters = parameters;
    }

});
Ext.reg('formalicious-panel-update',Formalicious.panel.Update);

Formalicious.grid.AdvancedParams = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: Formalicious.config.connectorUrl

        ,fields: ['id', 'key', 'value']
        ,autoHeight: true
        ,mode: 'local'
        ,viewConfig: {
            forceFit:true
            ,enableRowBody:true
            ,scrollOffset: 0
            ,autoFill: true
        }
        ,columns: [{
            header: _('formalicious.advanced.parameter')
            ,dataIndex: 'key'
            ,width: 200
        },{
            header: _('value')
            ,dataIndex: 'value'
            ,width: 250
        }]
        ,bbar: new Ext.Toolbar({
            items: [{
                text: _('formalicious.advanced.add_parameter')
                ,autoWidth: false
                ,style: {width: '100%'}
                ,handler: this.createParam
                ,scope: this
            }]
        })
    });
    Formalicious.grid.AdvancedParams.superclass.constructor.call(this,config);
    this.Record = new Ext.data.Record.create(['key','value']);
};

Ext.extend(Formalicious.grid.AdvancedParams,MODx.grid.LocalGrid,{

    getMenu: function() {
        var m = [];
        m.push({
            text: _('update')
            ,handler: this.updateParam
        });
        m.push('-');
        m.push({
            text: _('delete')
            ,handler: this.removeParam
        });
        return m;
    }
    ,createParam: function(btn,e) {
        var paramWindow = MODx.load({
            xtype: 'formalicious-window-param'
            ,listeners: {
                'success': {fn:function() {
                    // this.refresh();
                },scope:this}
            }
        });

        paramWindow.fp.getForm().reset();
        //paramWindow.fp.getForm().setValues(this.menu.record);
        paramWindow.show(e.target);
    }

    ,updateParam: function(btn,e) {
        var paramWindow = MODx.load({
            xtype: 'formalicious-window-param'
            ,record: this.menu.record
            ,isUpdate: true
            ,selected: this.getSelectionModel().getSelected().id
            ,listeners: {
                'success': {fn:function() {
                    // this.refresh();
                },scope:this}
            }
        });

        paramWindow.fp.getForm().reset();
        paramWindow.fp.getForm().setValues(this.menu.record);
        paramWindow.show(e.target);
    }

    ,removeParam: function(btn,e) {
        if (!this.menu.record) return false;

        Ext.Msg.confirm(
            _('formalicious.advanced.parameter_remove'),
            _('formalicious.advanced.parameter_remove_confirm'),
            function(e) {
                if (e == 'yes') {
                    var r = this.getSelectionModel().getSelected();
                    this.getStore().remove(r);
                }
            },this
        );
    }
});
Ext.reg('formalicious-grid-advanced-params',Formalicious.grid.AdvancedParams);

Formalicious.window.Param = function(config) {
    var uniqueId = Ext.id();
    config = config || {};
    Ext.applyIf(config,{
        title: _('formalicious.advanced.add_parameter')
        ,closeAction: 'close'
        ,width: 600
        ,url: Formalicious.config.connectorUrl
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('formalicious.advanced.parameter')
            ,name: 'key'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('value')
            ,name: 'value'
            ,anchor: '100%'
        }]
    });
    Formalicious.window.Param.superclass.constructor.call(this,config);
};

Ext.extend(Formalicious.window.Param,MODx.Window,{
    submit: function() {
        var v = this.fp.getForm().getValues();
        if (this.fp.getForm().isValid()) {
            if (this.fireEvent('success',v)) {
                this.fp.getForm().reset();
                this.destroy();
                var grid = Ext.getCmp('formalicious-grid-advanced-params');
                var store = grid.getStore();
                var index = store.getCount();
                if (index > 0) {
                    index = store.getCount() - 1;
                }
                var rec = new grid.Record({key: v.key, value: v.value});
                if (this.config.isUpdate) {
                    var record = store.getById(this.config.selected);
                    record.set('key', v.key);
                    record.set('value', v.value);
                    record.commit();
                } else {
                    store.insert(index, rec);
                }
                return true;
            }
        }
        return false;
    },
    close: function() {
        this.fp.getForm().reset();
        this.destroy();
    }
});
Ext.reg('formalicious-window-param', Formalicious.window.Param);

