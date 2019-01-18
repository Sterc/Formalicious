
Formalicious.grid.SavedForms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formalicious-grid-forms'
        ,url: Formalicious.config.connectorUrl
        ,baseParams: {
            action: 'mgr/savedform/getlist'
            ,form_id: MODx.request.id
        }
        ,fields: ['id','form','data', 'ip', 'time']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
        },{
            header: _('formalicious.data')
            ,dataIndex: 'data'
            ,width: 250
            ,renderer: function(value){
                var output = '';
                for(var k in value){
                    output += '<b>'+k+'</b>: '+value[k]+'\n';
                }
                return output;
            }
        },{
            header: _('formalicious.time')
            ,dataIndex: 'time'
            ,width: 250
            ,renderer: function(value) {
                var formDate = Date.parseDate(value, 'U');
                return formDate.format('Y/m/d H:i');
            }
        }]
    });
    Formalicious.grid.SavedForms.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.grid.SavedForms,MODx.grid.Grid,{
    windows: {}
    ,getMenu: function() {
        var m = [];
        m.push({
            text: 'view'
            ,handler: this.viewItem
        });
        m.push('-');
        m.push({
            text: 'remove'
            ,handler: this.remove
        });
        this.addContextMenuItem(m);
    }
    ,viewItem: function(btn,e) {
        if (!this.menu.record) return false;
        var fieldsOutput = '';
        for(var k in this.menu.record.data){
            fieldsOutput += '<b>'+k+'</b>: '+this.menu.record.data[k]+'<br/>';
        }

        var formDate = Date.parseDate(this.menu.record.time, 'U');

        var win = new Ext.Window({
            title: _('formalicious.data'),
            modal: true,
            width: 640,
            height: 400,
            preventBodyReset: true,
            html: '<p><b>'+_('formalicious.time')+':</b> '+formDate.format('Y/m/d H:i')+'<br/><b>IP:</b> '+this.menu.record.ip+'</p><hr/>'+fieldsOutput
        });
        win.show();
    }
    ,remove: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formalicious.form_remove')
            ,text: _('formalicious.form_remove_confirm')
            ,url: Formalicious.config.connectorUrl
            ,params: {
                action: 'mgr/savedform/remove'
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

    ,export: function(btn,e) {
        MODx.Ajax.request({
            url: Formalicious.config.connectorUrl
            ,params: {
                action: 'mgr/savedform/export'
                ,form_id: MODx.request.id
                ,startDate: Ext.getCmp('startdate').getValue()
                ,endDate: Ext.getCmp('enddate').getValue()
            }
            ,listeners: {
                'success': {fn:function(r) {
                    location.href = r.results.file;
                },scope:this}
            }
        });
    }

});
Ext.reg('formalicious-grid-saved-forms',Formalicious.grid.SavedForms);