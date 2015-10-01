Ext.ns('Ext.ux');
Ext.ux.TabTitleEditor = Ext.extend(Object, {
    init: function(c){
        c.on({
            render: this.onRender,
            destroy: this.onDestroy,
            single: true
        });
    },
    onRender: function(c){
        c.titleEditor = new Ext.Editor(new Ext.form.TextField({
            allowBlank: false,
            enterIsSpecial: true
        }), {
            autoSize: 'width',
            completeOnEnter: true,
            cancelOnEsc: true,
            listeners: {
                complete: function(editor, value){
                    var item = this.getComponent(editor.boundEl.id.split(this.idDelimiter)[1]);
                    MODx.Ajax.request({
                        url: Formalicious.config.connector_url
                        ,params: {
                            action: 'mgr/step/update'
                            ,title: value
                            ,id: item.step
                        }
                        ,listeners: {
                            'success': {fn:function(data) {
                                    item.setTitle(value);
                                
                            },scope:this}
                        }
                    });
                },
                scope: this
            }
        });
        c.mon(c.strip, {
            dblclick: function(e){
                var t = this.findTargets(e);
                if(t && t.item && !t.close && t.item.titleEditable !== false){
                    this.titleEditor.startEdit(t.el, t.item.title);
                }
            },
            scope: c
        });
    },
    onDestroy: function(c){
        if(c.titleEditor){
            c.titleEditor.destroy();
            delete c.titleEditor;
        }
    }
});
Ext.preg('tabtitleedit', Ext.ux.TabTitleEditor);

Formalicious.panel.ManageForm = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,style: 'background: #fbfbfb'
        ,id: 'formalicious-panel-form-wrapper'
        ,items: [{
            html: '<p>'+_('formalicious.settings.intro_msg')+'</p>'
            ,border: false
            ,bodyCssClass: 'panel-desc'
        },{
            xtype: 'panel'
            ,cls: 'container'
            ,items: [{
                xtype: 'button'
                ,text: _('formalicious.step.create')
                ,handler: function(btn, e){
                    MODx.Ajax.request({
                        url: Formalicious.config.connector_url
                        ,params: {
                            action: 'mgr/step/create'
                            ,form_id: MODx.request.id
                            ,title: _('new')
                        }
                        ,listeners: {
                            'success':{fn:function(data) {
                                //console.log(data);
                                // Ext.each(data.results, function(tabData) {
                                //     Ext.getCmp('formalicious-panel-form-steps').add({
                                //         title: tabData.title
                                //         ,items: [{
                                //             xtype: 'formalicious-grid-form-fields'
                                //             ,id: 'formalicious-panel-form-step-'+tabData.id
                                //             ,step: tabData.id
                                //             ,preventRender: true
                                //             ,cls: 'main-wrapper'
                                //         }]
                                //     });
                                // });
                                // Ext.getCmp('formalicious-panel-form-steps').setActiveTab(0);

                                var tabpanel = Ext.getCmp('formalicious-panel-form-steps');
                                var active = tabpanel.add({
                                    title: data.object.title
                                    ,step: data.object.id
                                    ,closable: true
                                    ,listeners: {
                                        beforeclose: function(tab) { //CODE BESTAAT 2 KEER!!!!!!!!!!!!!!!!!!!
                                            Ext.MessageBox.show({
                                                title: _('formalicious.step.remove'),
                                                msg: _('formalicious.step.remove.msg'),
                                                buttons: Ext.MessageBox.YESNO,
                                                fn: function(buttonId){
                                                    if(buttonId == 'yes'){
                                                        MODx.Ajax.request({
                                                            url: Formalicious.config.connector_url
                                                            ,params: {
                                                                action: 'mgr/step/remove'
                                                                ,id: tab.step
                                                            }
                                                            ,listeners: {
                                                                'success':{fn:function(data) {
                                                                    tab.ownerCt.remove(tab);
                                                                },scope:this}
                                                            }
                                                        }); 
                                                    }
                                                },
                                                scope: this
                                            });
                                            return false;
                                        }
                                    }
                                    ,items: [{
                                        xtype: 'formalicious-grid-form-fields'
                                        ,id: 'formalicious-panel-form-step-'+data.object.id
                                        ,step: data.object.id
                                        ,preventRender: true
                                        ,cls: 'main-wrapper'
                                    }]
                                });
                                tabpanel.setActiveTab(active);
                                active.fireEvent('dblclick', active);
                                //console.log(data);
                            },scope:this}
                        }
                    });                    
                    
                }
            },{
                xtype: 'modx-tabs'
                ,id: 'formalicious-panel-form-steps'
                ,defaults: { border: false ,autoHeight: true }
                ,border: true
                ,activeItem: 0
                ,hideMode: 'offsets'
                ,plugins: ['tabtitleedit']
                ,items: this.getTabs()
                // ,listeners: {
                //     beforeclose: this.removeTabConfirm
                // }
                // ,items: [{
                //     title: 'Page 1'
                //     ,items: [{
                //         xtype: 'formalicious-grid-form-fields'
                //     }]
                // },{
                //     title: 'Page 2'
                //     ,items: [{
                //         xtype: 'formalicious-grid-form-fields'
                //     }]
                // }]
            }]
        }]
    });
    //console.log(this);
    Formalicious.panel.ManageForm.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.panel.ManageForm,MODx.Panel,{
    getTabs: function() {
        setTimeout(function() {//Dirty fix
            MODx.Ajax.request({
                url: Formalicious.config.connector_url
                ,params: {
                    action: 'mgr/step/getlist'
                    ,form: MODx.request.id
                }
                ,listeners: {
                    'success': {fn:function(data) {
                        //console.log(data);
                        Ext.each(data.results, function(tabData) {
                            //console.log(tabData);
                            Ext.getCmp('formalicious-panel-form-steps').add({
                                title: tabData.title
                                ,step: tabData.id
                                ,closable: true
                                ,listeners: {
                                    beforeclose: function(tab) { //CODE BESTAAT 2 KEER!!!!!!!!!!!!!!!!!!!
                                        Ext.MessageBox.show({
                                            title: _('formalicious.step.remove'),
                                            msg: _('formalicious.step.remove.msg'),
                                            buttons: Ext.MessageBox.YESNO,
                                            fn: function(buttonId){
                                                if(buttonId == 'yes'){
                                                    MODx.Ajax.request({
                                                        url: Formalicious.config.connector_url
                                                        ,params: {
                                                            action: 'mgr/step/remove'
                                                            ,id: tab.step
                                                        }
                                                        ,listeners: {
                                                            'success':{fn:function(data) {
                                                                tab.ownerCt.remove(tab);
                                                            },scope:this}
                                                        }
                                                    }); 
                                                }
                                            },
                                            scope: this
                                        });
                                        return false;
                                    }
                                }
                                ,items: [{
                                    xtype: 'formalicious-grid-form-fields'
                                    ,id: 'formalicious-panel-form-step-'+tabData.id
                                    ,step: tabData.id
                                    //,preventRender: true
                                    ,cls: 'main-wrapper'
                                }]
                            });
                        });
                        Ext.getCmp('formalicious-panel-form-steps').setActiveTab(0);
                    },scope:this}
                }
            });
        },1250);
    }
    ,removeTabConfirm: function(tabpanel, tab){
        Ext.MessageBox.show({
          title: 'Save changes?',
          msg: 'Do you want to save changes?',
          buttons: Ext.MessageBox.YESNO,
          fn: function(buttonId){
            switch(buttonId){
              case 'no':
               // tab.ownerCt.remove(tab);   // manually removes tab from tab panel
                break;
              case 'yes':
                this.removeTab(tabpanel, tab);
                break;
              case 'cancel':
                // leave blank if no action required on cancel
                break;
            }
          },
          scope: this
        });
        return false;  // returning false to beforeclose cancels the close event
    }
});
Ext.reg('formalicious-panel-manage-form',Formalicious.panel.ManageForm);


Formalicious.grid.FormFields = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        //id: 'formalicious-grid-forms'
        url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/field/getlist'
            ,step_id: config.step
        }
        ,fields: ['id','step_id','name', 'title', 'introtext', 'directional', 'type', 'required', 'published', 'rank', 'show-values']
        ,autoHeight: true
        ,paging: false
        ,remoteSort: true
        // ,viewConfig: {
        //     forceFit:true
        //     ,enableRowBody:true
        //     ,scrollOffset: 0
        //     ,autoFill: true
        //     ,showPreview: true
        //     ,getRowClass : function(rec){
        //         return rec.data.active ? 'grid-row-active' : 'grid-row-inactive';
        //     }
        // }
        ,columns: [{
            header: _('formalicious.title')
            ,dataIndex: 'title'
            ,width: 200
        },{
            header: _('formalicious.type')
            ,dataIndex: 'type'
            ,width: 250
            // ,renderer: this.typeRenderer
            ,renderer: {
                fn: this.typeRenderer,
                scope: this
            }
        },{
            header: 'Actions'
            ,renderer: {
                fn: this.actionRenderer,
                scope: this
            }
        }]
        ,bbar: new Ext.Toolbar({
            cls: 'bbar-fullwidth'
            ,items: [
                {
                    text: _('formalicious.add_field')
                    ,autoWidth: false
                    ,style: {width: '100%'}
                    ,handler: this.createField
                    ,step: config.step
                    ,scope: this
                }
            ]
        })
        // [{
        //     text: _('formalicious.form_create')
        //     ,autoWidth: false
        //     ,style: {width: '100%'}
        //     ,handler: this.createField
        //     ,scope: this
        // }]

    });
    //this.fieldRecord = new Ext.data.Record.create(['id','step_id','name', 'title', 'introtext', 'directional', 'type', 'required', 'published', 'rank']);
    Formalicious.grid.FormFields.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.FormFields,MODx.grid.Grid,{
    windows: {}
    ,actionRenderer: function(value, metaData, record, rowIndex, colIndex, store) {
        var tpl = new Ext.XTemplate('<tpl for=".">' + '<tpl if="actions !== null">' + '<ul class="icon-buttons">' + '<tpl for="actions">' + '<li><button type="button" class="controlBtn {className}">{text}</button></li>' + '</tpl>' + '</ul>' + '</tpl>' + '</tpl>', {
            compiled: true
        });
        var values = {

        };
        var h = [];

        h.push({
            className: 'update formalicious-icon formalicious-icon-edit',
            text: _('update')
        });
        h.push({
            className: 'delete formalicious-icon formalicious-icon-remove',
            text: _('delete')
        });
        values.actions = h;
        return tpl.apply(values);
    }
    ,typeRenderer: function(value, metaData, record, rowIndex, colIndex, store) {
        MODx.Ajax.request({
            url: Formalicious.config.connector_url
            ,params: {
                action: 'mgr/fieldtype/get'
                ,id: value
            }
            ,listeners: {
                'success':{fn:function(data) {
                    return 'test';
                },scope:this}
            }
        });
        //return 'blaat : '+ding;
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
                this.updateField(record, e);
            break;

            case 'delete':
                this.removeField(record, e);
            break;
            }
        }
    }

    ,createField: function(btn,e) {
        var items = [];
        MODx.Ajax.request({
            url: Formalicious.config.connector_url
            ,params: {
                action: 'mgr/fieldtype/getlist'
            }
            ,listeners: {
                'success':{fn:function(data) {
                    Ext.each(data.results, function(fieldType) {
                        items.push({
                            xtype: 'button'
                            ,step_id: btn.step
                            ,text: fieldType.name
                            ,name: fieldType.name
                            ,type: fieldType.id
                            //,autoWidth: false
                            ,width: '30%'
                            ,style: 'float:left'
                        });
                    });

                    this.windows.createField = MODx.load({
                        xtype: 'formalicious-window-field-create'
                        ,id: 'window-field-create'
                        ,grid: this
                        ,title: 'test'
                        ,items: items
                    });

                    this.windows.createField.fp.getForm().reset();
                    this.windows.createField.show(e.target);
                },scope:this}
            }
             // ,listeners: {
            //     'success':{fn:function(data) {
            //         var count = 1;
            //         Ext.each(data.results, function(tabData) {
            //             console.log(items);
            //             items[mainColumn].items.push({
            //                 xtype: 'button'
            //                 ,text: data.name
            //                 ,name: data.name
            //                 //,autoWidth: false
            //                 ,width: '95%'
            //                 ,handler: this.submit
            //             });
            //             count = count+1;
            //             if(count % 3 == 1){
            //                 mainColumn = mainColumn+1;
            //             }
            //         });

            //         this.windows.createField = MODx.load({
            //             xtype: 'formalicious-window-field-create'
            //             ,id: 'window-field-create'
            //             ,grid: this
            //             ,title: 'test'
            //             ,items: items
            //         });

            //         this.windows.createField.fp.getForm().reset();
            //         this.windows.createField.show(e.target);
            //     },scope:this}
            // }
        });


    }

    ,updateField: function(btn,e,forcedData) {
        var r;
        if(!forcedData){
            if (!this.menu.record) return false;
            r = this.menu.record;
        }else{
            r = forcedData.object;
        }
        
        this.windows.updateField = MODx.load({
            xtype: 'formalicious-window-field-update'
            ,id: 'window-field-update'
            ,title: 'test'
            ,record: r
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.updateField.fp.getForm().reset();
        this.windows.updateField.fp.getForm().setValues(r);
        this.windows.updateField.show(e.target);

    }

    ,removeField: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formalicious.field_remove')
            ,text: _('formalicious.field_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/field/remove'
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
Ext.reg('formalicious-grid-form-fields',Formalicious.grid.FormFields);



Formalicious.window.CreateField = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        closeAction: 'close'
        ,url: Formalicious.config.connectorUrl
        ,maximized: true
        ,buttons:[]
        ,action: 'mgr/field/create'
        ,layout:'column'
        ,cls: 'button-window'
        ,defaults: {handler: this.submit}
    });
    Formalicious.window.CreateField.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.window.CreateField,MODx.Window,{
    submit: function(btn, e) {
        //console.log(btn);
        MODx.Ajax.request({
            url: Formalicious.config.connector_url
            ,params: {
                action: 'mgr/field/create'
                ,step_id: btn.step_id
                ,type: btn.type
                ,title: _('new')
            }
            ,listeners: {
                'success':{fn:function(data) {
                    
                    var window = Ext.getCmp('window-field-create');
                    var s = window.grid.getStore();
                    s.reload();

                    Ext.getCmp('window-field-create').close();

                    // this.updateField = MODx.load({
                    //     xtype: 'formalicious-window-field-update'
                    //     ,id: 'window-field-update'
                    //     //,grid: this
                    //     ,title: 'test'
                    //     //,items: items
                    // });

                    // this.updateField.fp.getForm().reset();
                    // this.updateField.fp.getForm().setValues(data.object);
                    // this.updateField.show(e.target);

                    Ext.getCmp('formalicious-panel-form-step-'+data.object.step_id).updateField({},{},data);

                    return false;
                    // var rec = new window.grid.fieldRecord(btn.data);
                    // s.add(rec);

                    // return false;

                },scope:this}
            }
        });      



    }

});
Ext.reg('formalicious-window-field-create',Formalicious.window.CreateField);


Formalicious.window.UpdateField = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        closeAction: 'close'
        ,url: Formalicious.config.connectorUrl
        ,action: 'mgr/field/update'
        ,height: 450
        ,width: 475
        ,closeAction: 'close'
        ,modal: true
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,id: this.ident+'-id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('name')
            ,name: 'name'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('title')
            ,name: 'title'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,name: 'position'
            ,id: this.ident+'-position'
            ,hidden: true
        },{
            xtype: 'formalicious-grid-values'
            ,border: true
            ,hidden: (config.record['show-values']) ? false : true
        },{
            xtype:'hidden'
            ,name: 'introtext'
        }]
        // ,listeners: [{
        //     beforesubmit: this.addValues
        // }]
    });
    Formalicious.window.UpdateField.superclass.constructor.call(this,config);
    this.on('beforesubmit', function (values) {
        values.introtext = 'test';
        var f = this.fp.getForm();
        f.setValues(values);
    });
};
Ext.extend(Formalicious.window.UpdateField,MODx.Window,{
    addValues: function(form){
        console.log(form);
    }
});
Ext.reg('formalicious-window-field-update',Formalicious.window.UpdateField);




Formalicious.grid.Values = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        autoHeight: true
        ,maxHeight: 300
        ,fields: ['value']
        //,hideHeaders:true
        ,columns: [{
            header: _('formalicious.values')
            ,dataIndex: 'value'
            ,editor: { xtype: 'textfield' ,allowBlank: false }
        }]
        ,tbar: ['-']
        ,bbar: new Ext.Toolbar({
            cls: 'bbar-fullwidth'
            ,items: [
                {
                    text: _('formalicious.add_value')
                    ,autoWidth: false
                    ,style: {width: '417px'}
                    ,handler: this.create
                    ,scope: this
                }
            ]
        })
    });
    Formalicious.grid.Values.superclass.constructor.call(this,config);
    this.optRecord = Ext.data.Record.create([{name: 'value'}]);
};
Ext.extend(Formalicious.grid.Values,MODx.grid.LocalGrid,{
    windows: {}
    ,create: function(btn,e) {
        this.addValue = MODx.load({
            xtype: 'formalicious-window-add-value'
            ,title: 'test'
            ,force:true
            ,blankValues: true
            ,listeners: {
                'success': {fn:function(r) {
                    //Stange because i used a modx-combo-boolean
                    var rec = new this.optRecord(r);
                    this.getStore().add(rec);
                },scope:this}
            }
        });

        this.addValue.fp.getForm().reset();
        //this.addValue.fp.getForm().setValues(r);
        this.addValue.show(e.target);

        // this.loadWindow(btn,e,{
        //     xtype: 'formalicious-window-add-value'
        //     ,force:true
        //     ,blankValues: true
        //     ,listeners: {
        //         'success': {fn:function(r) {
        //             //Stange because i used a modx-combo-boolean
        //             var rec = new this.optRecord(r);
        //             this.getStore().add(rec);
        //         },scope:this}
        //     }
        // });
    }
    ,updateRole: function(btn,e) {
        var r = this.menu.record;
        this.addValue = MODx.load({
            xtype: 'formalicious-window-add-value'
            ,title: 'test'
            ,force:true
            ,blankValues: true
            ,listeners: {
                'success': {fn:function(r) {
                    var s = this.getStore();
                    var rec = s.getAt(this.menu.recordIndex);
                    rec.set('value',r.value);
                },scope:this}
            }
        });

        this.addValue.fp.getForm().reset();
        this.addValue.fp.getForm().setValues(r);
        this.addValue.show(e.target);

        // this.loadWindow(btn,e,{
        //     xtype: 'formalicious-window-add-value'
        //     ,force:true
        //     ,record: r
        //     ,listeners: {
        //         'success': {fn:function(r) {
        //             console.log('update');
        //             var s = this.getStore();
        //             var rec = s.getAt(this.menu.recordIndex);
        //             rec.set('value',r.value);
        //         },scope:this}
        //     }
        // });
    }
    ,getMenu: function() {
        return [{
            text: _('user_role_update')
            ,handler: this.updateRole
            ,scope: this
        },{
            text: _('inyourface.field.remove')
            ,scope: this
            ,handler: this.remove.createDelegate(this,[{
                title: _('warning')
                ,text: _('inyourface.field.remove_confirm')
            }])
        }];
    }
});
Ext.reg('formalicious-grid-values',Formalicious.grid.Values);


Formalicious.window.AddValue = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('inyourface.field.create')
        ,height: 250
        ,width: 450
        ,modal: true
        ,saveBtnText: _('done')
        ,fields: [{
            fieldLabel: _('value')
            ,name: 'value'
            ,xtype: 'textfield'
            ,anchor: '100%'
            ,allowBlank: false
        }]
    });
    Formalicious.window.AddValue.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.window.AddValue,MODx.Window,{
    submit: function() {
        if (this.fp.getForm().isValid()) {
            if (this.fireEvent('success',this.fp.getForm().getValues())) {
                this.fp.getForm().reset();
                this.hide();
                return true;
            }
        }
        return false;
    }
});
Ext.reg('formalicious-window-add-value',Formalicious.window.AddValue);

