Ext.onReady(function() {
    MODx.load({ xtype: 'formalicious-page-update'});
});

Formalicious.page.Update = function(config) {
    config = config || {};
    Ext.applyIf(config,{
    	formpanel: 'formalicious-panel-update'
        ,components: [{
            xtype: 'formalicious-panel-update'
            ,renderTo: 'formalicious-panel-update-div'
        }]
        ,buttons: [{
            process: MODx.request.id ? 'mgr/form/update' : 'mgr/form/new'
            ,text: _('save')
            ,id: 'modx-abtn-save'
            ,cls: 'primary-button'
            ,method: 'remote'
            // ,checkDirty: true
            ,keys: [{
                key: MODx.config.keymap_save || 's'
                ,ctrl: true
            }]
        },{
            text: _('close')
            ,id: 'modx-abtn-cancel'
            ,handler: function() {
                MODx.loadPage('home', 'namespace='+MODx.request.namespace);
            }
        }]
    });
    Formalicious.page.Update.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.page.Update,MODx.Component);
Ext.reg('formalicious-page-update',Formalicious.page.Update);