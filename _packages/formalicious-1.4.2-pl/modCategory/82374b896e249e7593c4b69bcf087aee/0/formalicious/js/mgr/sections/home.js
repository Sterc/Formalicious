Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-home'
    });
});

Formalicious.page.Home = function(config) {
    config = config || {};

    config.buttons = [];

    config.buttons.push({
        text        : '<i class="icon icon-cogs"></i>' + _('formalicious.admin_view'),
        handler     : this.toAdminView,
        scope       : this
    });

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'formalicious-panel-home',
            renderTo    : 'formalicious-panel-home-div'
        }]
    });

    Formalicious.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Home, MODx.Component, {
    toAdminView : function() {
        MODx.loadPage('admin', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-home', Formalicious.page.Home);