window.addEventListener('load', function() {
	window.hexr = {
		sidenav: M.Sidenav.init(document.querySelectorAll('.sidenav')),
		parallax: M.Parallax.init(document.querySelectorAll('.parallax')),
		modals: M.Modal.init(document.querySelectorAll('.modal-trigger'))
	}
});
