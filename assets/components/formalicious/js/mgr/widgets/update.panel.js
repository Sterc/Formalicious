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
            //,'beforeSubmit': {fn:this.beforeSubmit,scope:this}
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
                        ,regex: /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;,.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*$/
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
                    },{
                        xtype: 'modx-combo-browser'
                        ,source: MODx.config['formalicious.source']
                        ,name: 'fiarattachment'
                        ,fieldLabel: _('formalicious.field.fiarattachment')
                        ,listeners: {
                            'select': {
                                fn:function(data) {
                                    Ext.getCmp('preview').setSrc(data.url, MODx.config['formalicious.source']);
 //                                   Ext.getCmp('image').setValue(data.fullRelativeUrl);
                                }
                            }
                        }
                    },{
                        id: 'preview'
                        ,fieldLabel: 'preview'
                        ,xtype: 'image'
                    }]
                }]
            },{
                title: _('formalicious.fields')
                ,xtype: 'formalicious-panel-manage-form'
                ,disabled: (MODx.request.id) ? false : true
                
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
                        Ext.getCmp('preview').setSrc(r.object.fiarattachment, MODx.config['formalicious.source']);
                        Ext.getCmp('modx-page-header').getEl().update('<h2>'+_('formalicious')+': '+r.object.name+'</h2>');
                        this.getForm().setValues(r.object);
                        this.fireEvent('ready',r.object);
                        MODx.fireEvent('ready');
                    },scope:this}
                }
            });
        }else{
            //Dirty fix. Won't work inside baseParams
            var r = {
                category_id: MODx.request.category
            };
            this.getForm().setValues(r);
            this.fireEvent('ready',r);
            MODx.fireEvent('ready');
        }
    }
    // ,beforeSubmit: function(o) {
    //     this.baseParams.content = Ext.encode(Ext.pluck(Ext.getCmp('pdfgenerator-grid-pdf').getStore().data.items, 'data'));
    // }
    ,success: function(o) {
        if(!MODx.request.id){
            MODx.loadPage(MODx.request.a, "action=update&id=" + o.result.object.id);
        }
    }

});
Ext.reg('formalicious-panel-update',Formalicious.panel.Update);
