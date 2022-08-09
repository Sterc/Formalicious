Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-update'
    });
});

Formalicious.page.Update = function(config) {
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
        text    : '<i class="icon icon-arrow-left"></i>' + _('formalicious.back_to_forms'),
        handler : this.toDefaultView,
        scope   : this
    }, {
        text    : _('save'),
        cls     : 'primary-button',
        method  : 'remote',
        process : MODx.request.id ? '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\Update' : '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\Create',
        checkDirty : true,
        keys    : [{
            ctrl    : true,
            keys    : MODx.config.keymap_save || 's'
        }]
    }, {
        text    : _('close'),
        handler : this.toDefaultView,
        scope   : this
    });

    if (Formalicious.config.branding_url_help) {
        config.buttons.push({
            text        : _('help_ex'),
            handler     : MODx.loadHelpPane,
            scope       : this
        });
    }

    Ext.applyIf(config, {
        formpanel   : 'formalicious-panel-update',
        components  : [{
            xtype       : 'formalicious-panel-update',
            renderTo    : 'formalicious-panel-update-div',
            record      : Formalicious.config.record
        }]
    });

    Formalicious.page.Update.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Update, MODx.Component, {
    loadBranding: function(btn) {
        window.open(Formalicious.config.branding_url);
    },
    toDefaultView : function() {
        MODx.loadPage('home', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-update', Formalicious.page.Update);