Formalicious.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('formalicious')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,id: 'formalicious-tabpanel-categories'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: this.getTabs()
            ,stateful: true
            ,stateId: 'formalicious-panel-home'
            ,stateEvents: ['tabchange']
            ,getState: function() {
                return {
                    activeTab:this.items.indexOf(this.getActiveTab())
                };
            },

        }]
    });
    Formalicious.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious.panel.Home,MODx.Panel,{
    getTabs: function() {
        MODx.Ajax.request({
            url: Formalicious.config.connector_url
            ,params: {
                action: 'mgr/category/getlist'
            }
            ,listeners: {
                'success':{fn:function(data) {
                    Ext.each(data.results, function(tabData) {
                        Ext.getCmp('formalicious-tabpanel-categories').add({
                            title: tabData.name
                            ,items: [{
                                xtype: 'formalicious-grid-forms'
                                ,id: 'formalicious-grid-forms-cat-'+tabData.id
                                ,category: tabData.id
                                ,preventRender: true
                                ,cls: 'main-wrapper'
                            }]
                        });
                    });
                    if(data.total == 0){
                       Ext.getCmp('formalicious-tabpanel-categories').add({
                            title: 'test'
                            ,id: 'no-results'
                            ,items: [{
                                cls: 'container'
                                ,html: _('formalicious.no-results')
                            }]
                        }); 
                    }
                    Ext.getCmp('formalicious-tabpanel-categories').setActiveTab(0);
                },scope:this}
            }
        });
    }
});
Ext.reg('formalicious-panel-home',Formalicious.panel.Home);