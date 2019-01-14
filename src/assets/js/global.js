window.addEventListener('load', function() {
	window.hexr = {
		sidenav: M.Sidenav.init(document.querySelectorAll('.sidenav')),
		modals: M.Modal.init(document.querySelectorAll('.modal'))
	}
});
