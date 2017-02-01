
Formalicious.grid.Forms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formalicious-grid-forms'
        ,url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/form/getlist'
            ,category: config.category
        }
        ,save_action: 'mgr/form/updatefromgrid'
        ,autosave: true
        ,fields: ['id','name','emailto', 'published']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
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
            header: _('formalicious.name')
            ,dataIndex: 'name'
            ,width: 400
            ,id: 'main'
            ,renderer: {
                fn: this.formTitleRenderer,
                scope: this
            }
        },{
            header: _('formalicious.emailto')
            ,dataIndex: 'emailto'
            ,width: 250
            ,renderer: {
                fn: this.formEmailToRenderer,
                scope: this
            }
        },{
            header: 'Actions'
            ,renderer: {
                fn: this.actionRenderer,
                scope: this
            }
        }]
        ,tbar: [{
            text: _('formalicious.form_create')
            ,handler: this.createForm
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,id: config.id+'-search-filter'
            ,emptyText: _('formalicious.search...')
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                },scope:this}
            }
        }]
    });
    Formalicious.grid.Forms.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.Forms,MODx.grid.Grid,{
    windows: {}
    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('update')
            ,handler: this.updateForm
        });
        m.push('-');
        m.push({
            text: _('delete')
            ,handler: this.removeForm
        });
        this.addContextMenuItem(m);
    }
    ,formTitleRenderer: function(value, metaData, record, rowIndex, colIndex, store) {
        return '<h3>'+value+' ('+record.id+')</h3>';
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
        // h.push({
        //     className: 'duplicate formalicious-icon formalicious-icon-duplicate',
        //     text: _('duplicate')
        // });
        h.push({
            className: 'delete formalicious-icon formalicious-icon-remove',
            text: _('delete')
        });
        values.actions = h;
        return tpl.apply(values);
    }
    ,formEmailToRenderer: function(value, metaData, record, rowIndex, colIndex, store) {
        var tpl = new Ext.XTemplate('<tpl for=".">' + '<ul class="emailto">' + '<tpl for="emailto">' + '<li>{emailaddress}</li>' + '</tpl>' + '</ul>' + '</tpl>', {
            compiled: true
        });
        var values = {
            emailto: []
        };

        var res = value.split(",");
        Ext.each(res, function(val) {
            values.emailto.push({
                emailaddress: val
            });
        });
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
                this.updateForm(record, e);
            break;

            case 'delete':
                this.removeForm(record, e);
            break;
            }
        }
    }

    ,createForm: function(btn,e) {
        MODx.loadPage('update', 'category='+this.category+'&namespace='+MODx.request.namespace);
    }
    ,updateForm: function(btn,e) {
        MODx.loadPage('update', 'category='+this.category+'&namespace='+MODx.request.namespace+'&id='+this.menu.record.id);
    }

    ,removeForm: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formalicious.form_remove')
            ,text: _('formalicious.form_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/form/remove'
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
Ext.reg('formalicious-grid-forms',Formalicious.grid.Forms);