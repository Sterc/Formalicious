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
                    html            : '<p>' + _('formalicious.category.intro_msg') + '</p>',
                    bodyCssClass    : 'panel-desc'
                }, {
                    xtype           : 'formalicious-grid-categories',
                    preventRender   : true,
                    cls             : 'main-wrapper'
                }]
            }, {
                title   : _('formalicious.fieldtype'),
                items   : [{
                    html            : '<p>' + _('formalicious.fieldtype.intro_msg') + '</p>',
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

Ext.extend(Formalicious.panel.Admin, MODx.Panel);

Ext.reg('formalicious-panel-admin', Formalicious.panel.Admin);