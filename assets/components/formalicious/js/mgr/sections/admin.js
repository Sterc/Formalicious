Ext.onReady(function() {
    MODx.load({ xtype: 'formalicious-page-admin'});
});

Formalicious.page.Admin = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'formalicious-panel-admin'
            ,renderTo: 'formalicious-panel-admin-div'
        }]
        ,buttons: [{
            text: _('close')
            ,handler: function() {
                MODx.loadPage('admin', 'namespace='+MODx.request.namespace);
            }
        }]
    });
    Formalicious.page.Admin.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.page.Admin,MODx.Component);
Ext.reg('formalicious-page-admin',Formalicious.page.Admin);