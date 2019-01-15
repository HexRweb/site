window.addEventListener('load', function () {
	/* This is all temporary until CSS animations are implemented
	function fadeIn(el) {
		let run = true;
		el.style.opacity = 0;

		let last = +new Date();
		function tick() {
			el.style.opacity = +el.style.opacity + (new Date() - last) / 400;
			last = +new Date();

			if (run && +el.style.opacity < 1) {
				(window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
			}
		};

		tick();

		return {
			stop: function () {
				run = false;
			}
		}
	}

	document.querySelectorAll('.project-coming-soon').forEach(function (element) {
		let ticker;
		element.addEventListener('mouseenter', function () {
			ticker = fadeIn(this.querySelector('.project-coming-soon-ribbon'));
		});
		element.addEventListener('mouseleave', function () {
			ticker && ticker.stop();
			let self = this;
			setTimeout(function () {
				self.querySelector('.project-coming-soon-ribbon').style.opacity = 0;
			}, 0);
		});
	});*/

	document.querySelectorAll('.project-logo').forEach(function(element) {
		element.addEventListener('click', function () {
			this.dataset.bindHref && window.open(this.dataset.bindHref);
		});
	});
});
