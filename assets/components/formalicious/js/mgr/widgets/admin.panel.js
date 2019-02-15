Formalicious.panel.Admin = function(config) {
    config = config || {};

    Ext.apply(config, {
        id      : 'formalicious-panel-admin',
        cls     : 'container',
        items   : [{
            html    : '<h2>' + _('formalicious') + '</h2>',
            cls     : 'modx-page-header'
        }, {
            xtype   : 'modx-tabs',
            items   : [{
                title   : _('formalicious.categories'),
                items   : [{
                    html            : '<p>' + _('formalicious.categories.desc') + '</p>',
                    bodyCssClass    : 'panel-desc'
                }, {
                    xtype           : 'formalicious-grid-categories',
                    preventRender   : true,
                    cls             : 'main-wrapper'
                }]
            }, {
                title   : _('formalicious.fieldtypes'),
                items   : [{
                    html            : '<p>' + _('formalicious.fieldtypes.desc') + '</p>',
                    bodyCssClass    : 'panel-desc'
                },{
                    xtype           : 'formalicious-grid-fieldtypes',
                    preventRender   : true,
                    cls             : 'main-wrapper'
                }]
            }]
        }]
    });

    Formalicious.panel.Admin.superclass.constructor.call(this,config);
};

Ext.extend(Formalicious.panel.Admin, MODx.FormPanel);

Ext.reg('formalicious-panel-admin', Formalicious.panel.Admin);