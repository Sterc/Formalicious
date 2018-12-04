Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-admin'
    });
});

Formalicious.page.Admin = function(config) {
    config = config || {};

    config.buttons = [];

    config.buttons.push({
        text        : '<i class="icon icon-eye"></i>' + _('formalicious.default_view'),
        handler     : this.toDefaultView,
        scope       : this
    });

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'formalicious-panel-admin',
            renderTo    : 'formalicious-panel-admin-div'
        }]
    });

    Formalicious.page.Admin.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Admin, MODx.Component, {
    toDefaultView : function() {
        MODx.loadPage('home', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-admin', Formalicious.page.Admin);