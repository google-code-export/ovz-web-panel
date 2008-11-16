Ext.onReady(function(){

	function columnVeStateRenderer(veState) {
		if (1 == veState) {
			return '<img src="/skins/win_xp/images/on.gif"/>';
		} else {
			return '<img src="/skins/win_xp/images/off.gif"/>';
		}
	}
	
	function addVirtualServer() {
		alert('implement addVirtualServer');
	}
		
	function removeVirtualServer() {
		var selectedItem = Ext.getCmp('virtualServersGrid').getSelectionModel().getSelected();
		
		if (!selectedItem) {
			Ext.MessageBox.show({
				title: 'Error',
				msg: 'Please select a virtual server.',
				buttons: Ext.Msg.OK,
				icon: Ext.MessageBox.ERROR
			});
			
			return ;
		}
		
		Ext.MessageBox.confirm('Confirm', 'Are you sure you want to remove virtual server with id <b>' + selectedItem.get('veId') + '</b>?', function(button, text) {
			if ('yes' == button) {				
				Ext.Ajax.request({
					url: '/admin/virtual-server/delete',
					success: function(response) {
						var result = Ext.util.JSON.decode(response.responseText);
						
						if (!result.success) {
							Ext.MessageBox.show({
								title: 'Error',
								msg: 'Server deletion request failed.',
								buttons: Ext.Msg.OK,
								icon: Ext.MessageBox.ERROR
							});
						
							return ;
						}
						
						gridVirtualServers.store.reload();
					},
					params: { 
						id: selectedItem.get('id')
					}
				});
			}
		});
	}
	
	var store = new Ext.data.JsonStore({
		url: '/admin/virtual-server/list-data/hw-server-id/' + Owp.Views.Admin.HardwareServer.Show.hwServerId,
		fields: [
			{ name: 'id' },
			{ name: 'veId' },
			{ name: 'ipAddress' },
			{ name: 'hostName' },
			{ name: 'veState' }
		]
	});

	store.load();
	
	var selectionModel = new Ext.grid.CheckboxSelectionModel({ singleSelect: true });

	var gridVirtualServers = new Ext.grid.GridPanel({
		id: 'virtualServersGrid',
		title: 'Virtual servers list',
		store: store,
		cm: new Ext.grid.ColumnModel([
			selectionModel, 
			{ id: 'veState', header: "State", renderer: columnVeStateRenderer, width: 60, align: 'center', sortable: true, dataIndex: 'veState' },
			{ id: 'veId', header: "Virtual Server ID", sortable: true, dataIndex: 'veId' },
			{ id: 'ipAddress', header: "IP Address", sortable: true, dataIndex: 'ipAddress' },
			{ id: 'hostName', header: "Host Name", sortable: true, dataIndex: 'hostName' }
		]),
		sm: selectionModel,
		stripeRows: true,
		autoExpandColumn: 'hostName',
		autoHeight: true,
		autoWidth: true,
		stripeRows: true,
		frame: true,
		tbar: [{
			text: 'Create virtual server',
			handler: addVirtualServer,
			cls: 'x-btn-text-icon addServer'
		}, {
			text: 'Remove virtual server',
			handler: removeVirtualServer,
			cls: 'x-btn-text-icon removeServer'
		}]
	});
	
	gridVirtualServers.render('virtualServersList');
});
