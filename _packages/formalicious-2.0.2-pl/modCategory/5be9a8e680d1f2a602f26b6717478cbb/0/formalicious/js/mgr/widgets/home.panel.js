Formalicious.panel.Home = function(config) {
    config = config || {};

    Ext.apply(config,{
        id      : 'formalicious-panel-home',
        cls     : 'container',
        items   : [{
            html    : '<h2>' + _('formalicious') + '</h2>',
            cls     : 'modx-page-header'
        }, {
            xtype   : 'modx-tabs',
            items   : this.getTabs()
        }]
    });

    Formalicious.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.panel.Home, MODx.FormPanel, {
    getTabs : function() {
        var tabs = [];

        if (Formalicious.config.categories.length >= 1) {
            Formalicious.config.categories.forEach(function (tab) {
                tabs.push({
                    title   : tab.name,
                    items   : [{
                        html        : '<p>' + tab.description + '</p>',
                        bodyCssClass : 'panel-desc'
                    }, {
                        xtype       : 'formalicious-grid-forms',
                        id          : 'formalicious-grid-forms-' + tab.id,
                        category    : tab.id,
                        preventRender : true,
                        cls         : 'main-wrapper'
                    }]
                });
            });
        } else {
            tabs.push({
                title   : _('formalicious'),
                items   : [{
                    cls     : 'container',
                    html    : _('formalicious.no_forms')
                }]
            });
        }

        return tabs;
    }
});

Ext.reg('formalicious-panel-home', Formalicious.panel.Home);