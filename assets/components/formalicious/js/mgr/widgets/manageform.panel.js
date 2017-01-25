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
            html: '<p>'+_('formalicious.fields.intro_msg')+'</p>'
            ,border: false
            ,bodyCssClass: 'panel-desc'
            ,cls: 'main-wrapper'
            ,style: 'padding-top:5px;'
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
                            ,title: _('formalicious.new_step', {'number': ''})
                        }
                        ,listeners: {
                            'success':{fn:function(data) {

                                var tabpanel = Ext.getCmp('formalicious-panel-form-steps');
                                var active = tabpanel.add({
                                    title: data.object.title
                                    ,step: data.object.id
                                    ,closable: true
                                    ,listeners: {
                                        beforeclose: function(tab) {
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
                            },scope:this}
                        }
                    });
                }
            },{
                xtype: 'ddtabpanel'
                ,id: 'formalicious-panel-form-steps'
                ,defaults: { border: false ,autoHeight: true }
                ,border: true
                ,activeItem: 0
                ,hideMode: 'offsets'
                ,plugins: ['tabtitleedit']
                ,enableTabScroll: true
                ,items: this.getTabs()
                ,listeners: {
                    reorder: function(tabpanel, tab, oldIndex, newIndex){
                        var newOrder = [];
                        Ext.each(tabpanel.items.items, function(tabData) {
                            newOrder.push(tabData.step);
                        });
                        MODx.Ajax.request({
                            url: Formalicious.config.connectorUrl
                            ,params: {
                                action: 'mgr/step/reorder'
                                ,newOrder: newOrder.join(",")
                                ,form_id: MODx.request.id
                            }
                        });
                    }
                }
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
});
Ext.reg('formalicious-panel-manage-form',Formalicious.panel.ManageForm);


Formalicious.grid.FormFields = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/field/getlist'
            ,step_id: config.step
        }
        ,fields: ['id','step_id', 'title', 'placeholder', 'introtext', 'directional', 'type', 'typetext', 'required', 'published', 'rank', 'show-values']
        ,autoHeight: true
        ,paging: false
        ,remoteSort: true
        ,ddGroup: 'bxrextraItemDDGroup'
        ,enableDragDrop: true
        ,viewConfig: {
            forceFit:true
            ,enableRowBody:true
            ,scrollOffset: 0
            ,autoFill: true
            ,showPreview: true
            ,getRowClass : function(rec){
                return rec.data.published ? 'grid-row-active' : 'grid-row-inactive';
            }
        }
        ,columns: [{
            header: _('formalicious.title')
            ,dataIndex: 'title'
            ,width: 200
        },{
            header: _('formalicious.type')
            ,dataIndex: 'typetext'
            ,width: 250
        },{
            header: 'Actions'
            ,renderer: {
                fn: this.actionRenderer,
                scope: this
            }
        }]
        ,tbar: new Ext.Toolbar({
            items: [
                {
                    text: _('formalicious.add_field')
                    ,autoWidth: false
                    ,handler: this.createField
                    ,step: config.step
                    ,scope: this
                }
            ]
        })
        ,listeners: {
            'render': function(g) {
                var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    copy: false
                    ,listeners: {
                        'beforerowmove': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowmove': function(objThis, oldIndex, newIndex, records) {

                            var newOrder = [];
                            Ext.each(objThis.target.grid.store.data.items, function(gridItem) {
                                newOrder.push(gridItem.id);
                            });

                            MODx.Ajax.request({
                                url: Formalicious.config.connectorUrl
                                ,params: {
                                    action: 'mgr/field/reorder'
                                    ,newOrder: newOrder.join(",")
                                    ,form_id: MODx.request.id
                                }
                                ,listeners: {
                                    
                                }
                            });
                        }

                        ,'beforerowcopy': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowcopy': function(objThis, oldIndex, newIndex, records) {
                        }
                    }
                });

                Ext.dd.ScrollManager.register(g.getView().getEditorParent());
            }
            ,beforedestroy: function(g) {
                Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
            }
        }

    });
    Formalicious.grid.FormFields.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.FormFields,MODx.grid.Grid,{
    windows: {}
    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('update')
            ,handler: this.updateField
        });
        m.push('-');
        m.push({
            text: _('delete')
            ,handler: this.removeField
        });
        this.addContextMenuItem(m);
    }
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
                            //,style: 'float:left; background-image: url(/'+fieldType.icon+'); background-position: center 10px; padding-top:60px;'
                        });
                    });

                    this.windows.createField = MODx.load({
                        xtype: 'formalicious-window-field-create'
                        ,id: 'window-field-create'
                        ,grid: this
                        ,title: _('formalicious.field_create')
                        ,items: items
                    });

                    this.windows.createField.fp.getForm().reset();
                    this.windows.createField.show(e.target);
                },scope:this}
            }
        });
    }

    ,updateField: function(btn,e,forcedData) {
        var r;
        if(!forcedData){
            if (!this.menu.record) return false;
            r = this.menu.record;
        } else{
            r = forcedData.object;
        }
        
        this.windows.updateField = MODx.load({
            xtype: 'formalicious-window-field-update'
            ,id: 'window-field-update'
            ,title: _('formalicious.field_save')
            ,record: r
            ,listeners: {
                'success': {
                    fn:function(e) {
                        this.refresh();
                }, scope:this}
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
        ,maximizable: false
        ,minimizable: false
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
                //,title: _('new')
            }
            ,listeners: {
                'success':{fn:function(data) {
                    var window = Ext.getCmp('window-field-create');
                    var s = window.grid.getStore();
                    s.reload();

                    Ext.getCmp('window-field-create').close();

                    data.object.published = true;
                    Ext.getCmp('formalicious-panel-form-step-'+data.object.step_id).updateField({},{},data);

                    return false;

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
        ,xtype: 'form'
        ,height: 550
        ,width: 475
        ,modal: true
        ,items:[{
            xtype:'form',
            'id': 'update-form',
            url: Formalicious.config.connectorUrl,
            baseParams: {
                action: 'mgr/field/update'
            },
            action: 'mgr/field/update',
            items: [{
                xtype: 'hidden'
                ,name: 'id'
                ,value: config.record.id
            },{
                xtype: 'hidden'
                ,name: 'step_id'
                ,value: config.record.step_id
            },{
                xtype: 'hidden'
                ,name: 'type'
                ,value: config.record.type
            },{
                xtype: 'textfield'
                ,fieldLabel: _('formalicious.field.title')
                ,name: 'title'
                ,anchor: '100%'
                ,allowBlank: false
                ,value: config.record.title
            },{
                xtype: 'textfield'
                ,fieldLabel: _('formalicious.field.placeholder')
                ,name: 'placeholder'
                ,anchor: '100%'
                ,value: config.record.placeholder
            },{
                xtype: 'hidden'
                ,fieldLabel: _('description')
                ,name: 'introtext'
                ,anchor: '100%'
                ,value: config.record.description
            },{
                xtype: 'checkbox'
                ,name: 'required'
                ,boxLabel: _('formalicious.field.required')
                ,inputValue: 1
                ,checked: (config.record.required) ? true : false
            },{
                xtype: 'checkbox'
                ,name: 'published'
                ,boxLabel: _('formalicious.field.published')
                ,inputValue: 1
                ,checked: (config.record.published) ? true : false
            },{
                xtype: 'hidden'
                ,name: 'rank'
                ,value: config.record.rank
            },{
                xtype: 'formalicious-grid-values'
                ,id: 'grid-values'
                ,field_id: config.record.id
                ,border: true
                ,hidden: (config.record['show-values']) ? false : true
            }, {
                xtype: 'label'
                ,id: 'grid-values-required'
                ,text: _('formalicious.field.values_required')
                ,cls: 'desc-under'
                ,style: 'color: #BE0000'
                ,width: 500
                ,hidden: true
            }]
        }]
        ,buttons: [{
            text: _('formalicious.close'),
            handler: function() {
                Ext.getCmp('window-field-update').destroy();
            }
        }, {
            text: _('formalicious.save'),
            handler: function(btn, event) {
                var form = Ext.getCmp('update-form').getForm();

                /**
                 * Add check of gridvalues.
                 */
                if (config.record['show-values'] === true && Ext.getCmp('grid-values').store.data.length <= 0) {
                    Ext.getCmp('grid-values-required').show();
                    return false;
                } else {
                    Ext.getCmp('grid-values-required').hide();
                }

                if (form.isValid()) {
                    form.submit({
                        url: Formalicious.config.connectorUrl
                        ,action: 'mgr/field/update'
                        ,baseParams: {
                            action: 'mgr/field/update'
                        }
                        ,renderTo: Ext.getBody()
                        ,success: function(form, action) {
                            Ext.getCmp('formalicious-panel-form-step-' + config.record.step_id).store.reload();
                            Ext.getCmp('window-field-update').destroy();
                        }
                    });
                }
            }
        }]
    });

    Formalicious.window.UpdateField.superclass.constructor.call(this, config);
};
Ext.extend(Formalicious.window.UpdateField,MODx.Window);
Ext.reg('formalicious-window-field-update',Formalicious.window.UpdateField);

Formalicious.grid.Values = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'grid-values'
        ,autoHeight: true
        ,maxHeight: 300
        ,fields: ['id', 'field_id', 'name', 'rank', 'published', 'subfield_id']
        ,url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/answer/getlist'
            ,field_id: config.field_id
        }
        ,remoteSort: true
        ,ddGroup: 'bxrextraItemDDGroup'
        ,enableDragDrop: true
        ,columns: [{
            header: _('formalicious.values')
            ,dataIndex: 'name'
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
        ,listeners: {
            'render': function(g) {
                var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    copy: false
                    ,listeners: {
                        'beforerowmove': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowmove': function(objThis, oldIndex, newIndex, records) {

                            var newOrder = [];
                            Ext.each(objThis.target.grid.store.data.items, function(gridItem) {
                                newOrder.push(gridItem.id);
                            });

                            MODx.Ajax.request({
                                url: Formalicious.config.connectorUrl
                                ,params: {
                                    action: 'mgr/answer/reorder'
                                    ,newOrder: newOrder.join(",")
                                    ,field_id: config.field_id
                                }
                                ,listeners: {
                                    
                                }
                            });
                        }

                        ,'beforerowcopy': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowcopy': function(objThis, oldIndex, newIndex, records) {
                        }
                    }
                });

                Ext.dd.ScrollManager.register(g.getView().getEditorParent());
            }
            ,beforedestroy: function(g) {
                Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
            }
        }
    });
    Formalicious.grid.Values.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.Values,MODx.grid.Grid,{
    windows: {}
    ,create: function(btn,e) {
        this.windows.addValue = MODx.load({
            xtype: 'formalicious-window-add-value'
            ,action: 'mgr/answer/create'
            ,title: _('formalicious.add_value')
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.addValue.fp.getForm().reset();
        this.windows.addValue.fp.getForm().setValues({'field_id': this.baseParams.field_id, 'published': true});
        this.windows.addValue.show(e.target);
    }
    ,update: function(btn,e) {
        var r = this.menu.record;
        this.windows.addValue = MODx.load({
            xtype: 'formalicious-window-add-value'
            ,action: 'mgr/answer/update'
            ,title: _('formalicious.value_update')
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.addValue.fp.getForm().reset();
        this.windows.addValue.fp.getForm().setValues(r);
        this.windows.addValue.show(e.target);
    }
    ,remove: function(btn,e) {
        if (!this.menu.record) return false;
        if(!e) return false; //Dirty fix for closing window
        MODx.msg.confirm({
            title: _('formalicious.value_remove')
            ,text: _('formalicious.value_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/answer/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }
    ,getMenu: function() {
        return [{
            text: _('formalicious.value_update')
            ,handler: this.update
            ,scope: this
        },{
            text: _('formalicious.value_remove')
            ,scope: this
            ,handler: this.remove
        }];
    }
});
Ext.reg('formalicious-grid-values',Formalicious.grid.Values);


Formalicious.window.AddValue = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('inyourface.field.create')
        ,url: Formalicious.config.connectorUrl
        // ,height: 450
        ,autoHeight: true
        ,width: 450
        ,modal: true
        ,saveBtnText: _('done')
        ,closeAction: 'close'
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            fieldLabel: _('value')
            ,name: 'name'
            ,xtype: 'textfield'
            ,anchor: '100%'
            ,allowBlank: false
        },{
            xtype: 'hidden'
            ,name: 'field_id'
        },{
            xtype: 'hidden'
            ,name: 'rank'
        },{
            xtype: 'checkbox'
            ,name: 'published'
            ,fieldLabel: _('formalicious.field.published')
            ,inputValue: 1
        },{
            xtype: 'hidden'
            ,name: 'subfield_id'
        }]
    });
    Formalicious.window.AddValue.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.window.AddValue,MODx.Window);
Ext.reg('formalicious-window-add-value',Formalicious.window.AddValue);