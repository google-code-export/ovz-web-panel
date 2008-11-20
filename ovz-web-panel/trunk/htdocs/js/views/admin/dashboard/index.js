Ext.onReady(function() {
	var dashboardIntro = new Ext.Panel({
		title: 'Intro',
		applyTo: 'dashboardIntro',
		collapsible: true
	});
	
	var dashboardFirstSteps = new Ext.Panel({
		title: 'First steps',
		applyTo: 'dashboardFirstSteps',
		collapsible: true
	});
	
	var shortcutsButtons = new Array();

	Ext.each(Owp.Views.Admin.Dashboard.Index.shortcuts, function(shortcut) {
		shortcutsButtons.push(new Ext.Button({
				text: shortcut.name,
				cls: 'shortcutButton',
				handler: function() {
					document.location.href = shortcut.link;
				}
			})
		);
	});
		
	var dashboardShortcuts = new Ext.Panel({
		title: 'Shortcuts',
		bodyStyle: 'padding-left: 10px; padding-top: 10px;',
		renderTo: 'dashboardShortcuts',
		collapsible: true,
		items: shortcutsButtons,
		tbar: [{
			text: 'Add shortcut',
			handler: function() {
				Owp.Layouts.Admin.addShortcut(true);
			},
			cls: 'x-btn-text-icon addShortcut'
		}, {
			text: 'Delete shortcut',
			handler: function() {
				alert('implement shortcut removing');
			},
			cls: 'x-btn-text-icon deleteShortcut'
		}]
	});
});