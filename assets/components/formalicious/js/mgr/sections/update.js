Ext.onReady(function() {
    MODx.load({
        xtype : 'formalicious-page-update'
    });
});

Formalicious.page.Update = function(config) {
    config = config || {};

    config.buttons = [];

    config.buttons.push({
        text    : '<i class="icon icon-arrow-left"></i>' + _('formalicious.back_to_forms'),
        handler : this.toDefaultView,
        scope   : this
    }, {

        text    : _('save'),
        cls     : 'primary-button',
        method  : 'remote',
        process : MODx.request.id ? 'mgr/form/update' : 'mgr/form/new',
        //checkDirty: true,
        keys    : [{
            ctrl    : true,
            keys    : MODx.config.keymap_save || 's'
        }]
    }, {
        text    : _('close'),
        handler : this.toDefaultView,
        scope   : this
    });

    Ext.applyIf(config, {
        formpanel   : 'formalicious-panel-update',
        components  : [{
            xtype       : 'formalicious-panel-update',
            renderTo    : 'formalicious-panel-update-div'
        }]
    });
    Formalicious.page.Update.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.page.Update, MODx.Component, {
    toDefaultView : function() {
        MODx.loadPage('home', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('formalicious-page-update', Formalicious.page.Update);