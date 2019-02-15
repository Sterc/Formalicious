Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-home'
    });
});

Formalicious.page.Home = function(config) {
    config = config || {};

    config.buttons = [];

    if (Formalicious.config.branding_url) {
        config.buttons.push({
            text        : 'Formalicious ' + Formalicious.config.version,
            cls         : 'x-btn-branding',
            handler     : this.loadBranding
        });
    }

    if (Formalicious.config.permissions.admin) {
        config.buttons.push({
            text   : '<i class="icon icon-cogs"></i>' + _('formalicious.admin_view'),
            handler: this.toAdminView,
            scope  : this
        });
    }

    if (Formalicious.config.branding_url_help) {
        config.buttons.push({
            text        : _('help_ex'),
            handler     : MODx.loadHelpPane,
            scope       : this
        });
    }

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'formalicious-panel-home',
            renderTo    : 'formalicious-panel-home-div'
        }]
    });

    Formalicious.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Home, MODx.Component, {
    loadBranding: function(btn) {
        window.open(Formalicious.config.branding_url);
    },
    toAdminView : function() {
        MODx.loadPage('admin', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-home', Formalicious.page.Home);