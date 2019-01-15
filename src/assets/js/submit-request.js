window.addEventListener('load', function () {
	const form = document.getElementById('request-site');
	const submit = form.querySelector('button');
	const errors = form.parentNode.querySelector('.error-list');

	function getField(id) {
		return form.querySelector('#' + id).value;
	}

	function setErrors(errorList) {
		errors.innerHTML = '';
		errorList.forEach(error => {
			const elem = document.createElement('p');
			elem.textContent = error;
			errors.appendChild(elem);
		});
		errors.scrollIntoView({behavior: 'smooth'});
	}

	form.addEventListener('submit', function sendRequest(event) {
		event.preventDefault();

		if (!form.reportValidity()) {
			return;
		}

		const captcha = grecaptcha.getResponse();

		if (!captcha) {
			setErrors(['Please prove you are not a robot']);
			return;
		}

		const payload = {
			submitted: 1,
			first_name: getField('first_name'),
			last_name: getField('last_name'),
			email: getField('email'),
			phone: getField('phone').replace(/^[0-9]/g, ''),
			organization: getField('organization'),
			website: getField('website'),
			'org-desc': getField('org-desc'),
			'org-web-requirements': getField('org-web-requirements'),
			'num-employees': getField('num-employees'),
			profit: form.querySelector('#profit').checked,
			'g-recaptcha-response': captcha,
			income: getField('income')
		};

		submit.innerHTML = 'Submitting...';
		submit.disabled = true;
		fetch('https://fn.hexr.org/request-a-site', {
			method: 'POST',
			headers: {'content-type': 'application/json'},
			body: JSON.stringify(payload)
		}).then(response => response.json()).then(response => {
			submit.innerHTML = 'Submitted!';
			if (response.errors && response.errors.length > 0) {
				grecaptcha.reset();
				submit.disabled = false;
				return setErrors(response.errors);
			}

			document.getElementById('request').innerHTML =
			`<div class="modal-content row black-text">
				<h1>Success!</h1>
				<p class="flow-text">Thanks for requesting a site! We'll get back to you soon 😊</p>
			</div>`;
		}).catch(error => {
			console.error(error);
			setErrors(['An error occurred. Please email us directly to request a site']);
		});
	});
});
