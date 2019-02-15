var Formalicious = function(config) {
    config = config || {};

    Formalicious.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious, Ext.Component, {
    page    : {},
    window  : {},
    grid    : {},
    tree    : {},
    panel   : {},
    combo   : {},
    config  : {},
    loadRTE : function(id, config) {
        if (parseInt(MODx.config['formalicious.use_editor']) === 1 && !Ext.isEmpty(MODx.config.which_editor)) {
            config = config || {};
            config.selector = '#' + id;

            if (MODx.config.which_editor === 'TinyMCE RTE') {
                config.skin = MODx.config['tinymcerte.skin'];

                new TinyMCERTE.Tiny({
                    allowDrop : true
                }, config);
            } else {
                MODx.loadRTE(id, config);
            }
        }
    }
});

Ext.reg('formalicious', Formalicious);

Formalicious = new Formalicious();
