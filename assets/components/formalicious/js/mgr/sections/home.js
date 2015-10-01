Ext.onReady(function() {
    MODx.load({ xtype: 'formalicious-page-home'});
});

Formalicious.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'formalicious-panel-home'
            ,renderTo: 'formalicious-panel-home-div'
        }]
        ,buttons: [{
            text: 'Admin panel'
            ,handler: function() {
                MODx.loadPage(MODx.request.a, 'action=admin');
            }
        }]
    });
    Formalicious.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.page.Home,MODx.Component);
Ext.reg('formalicious-page-home',Formalicious.page.Home);