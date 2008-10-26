OvzWebPanel.Layouts.Admin = {};

OvzWebPanel.Layouts.Admin.onLogoutLinkClick = function() {
	Ext.MessageBox.confirm('Confirm', 'Are you sure you want to log out?', function(button, text) {
		if ('yes' == button) {
			window.location.href = '/auth/logout';
		}
	});
}

Ext.onReady(function(event) {
		
	var layout = new Ext.Viewport({
		layout:'border',
		items:[
			new Ext.BoxComponent({
				region: 'north',
				el: 'panelHeader',
				cls: 'x-panel-header',
				height: 50
			}), {
				region: 'west',
				title: 'Menu',
				contentEl: 'panelMenu',
				split:true,
				width: 250,
				minSize: 200,
				maxSize: 400,
				collapsible: true,
				margins: '5 0 5 5',
				layout: 'accordion',
				layoutConfig: { animate: true },				
				xtype: 'treepanel',
				loader: new Ext.tree.TreeLoader(),
				rootVisible: false,
				lines: false,
				root: OvzWebPanel.Layouts.Admin.getMainMenu()
			}, {
				region: 'center',
				margins: '5 5 5 0',
				contentEl: 'panelContent'
			}
		]
	});
	
});
