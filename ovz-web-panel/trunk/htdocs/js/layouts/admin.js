OvzWebPanel.Layouts.Admin = {};

OvzWebPanel.Layouts.Admin.autoResizeContentArea = function() {
	var contentHeightOffset = 91;	
	var contentWidthOffset = 250;	
	var layoutContent = document.getElementById('layoutContent');
	
	layoutContent.style.height = (document.body.scrollHeight - contentHeightOffset) + 'px';
	layoutContent.style.width = (document.body.scrollWidth - contentWidthOffset) + 'px';
}

OvzWebPanel.Layouts.Admin.observeListRowsHighlight = function() {
	highlightRowCallback = function(listRow) {
		listRow.observe('mouseover', function(event) {
			listRow.addClassName('tableRowHighlighted');
		});
		
		listRow.observe('mouseout', function(event) {
			listRow.removeClassName('tableRowHighlighted');
		});
	}
	
	$$('tr').each(highlightRowCallback);
}

Event.observe(window, 'load', function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
	OvzWebPanel.Layouts.Admin.observeListRowsHighlight();
});

Event.observe(window, 'resize', function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
});
