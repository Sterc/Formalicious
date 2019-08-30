Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-admin'
    });
});

Formalicious.page.Admin = function(config) {
    config = config || {};

    config.buttons = [];

    if (Formalicious.config.branding_url) {
        config.buttons.push({
            text        : 'Formalicious ' + Formalicious.config.version,
            cls         : 'x-btn-branding',
            handler     : this.loadBranding
        });
    }

    config.buttons.push({
        text        : '<i class="icon icon-eye"></i>' + _('formalicious.default_view'),
        handler     : this.toDefaultView,
        scope       : this
    });

    if (Formalicious.config.branding_url_help) {
        config.buttons.push({
            text        : _('help_ex'),
            handler     : MODx.loadHelpPane,
            scope       : this
        });
    }

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'formalicious-panel-admin',
            renderTo    : 'formalicious-panel-admin-div'
        }]
    });

    Formalicious.page.Admin.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Admin, MODx.Component, {
    loadBranding: function(btn) {
        window.open(Formalicious.config.branding_url);
    },
    toDefaultView : function() {
        MODx.loadPage('home', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-admin', Formalicious.page.Admin);