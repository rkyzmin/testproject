document.addEventListener('DOMContentLoaded', function () {
	const xhttp = new XMLHttpRequest();

	if (document.querySelector('.add-new-element') !== null) {
		document.querySelector('.add-new-element').addEventListener('click', () => {
			document.querySelector('.modal-block-add-item').style.display = 'block';
		});
		document.querySelectorAll('.add-children-block').forEach(element => {
			element.addEventListener('click', (e) => {
				document.querySelector('.modal-block-add-item').style.display = 'block';
				console.log(e.target.dataset.id)
				document.querySelector('#ch_id').value = e.target.dataset.id;
			});
		});

	}

	if (document.querySelector('.modal-block-add-item__form') !== null) {
		document.querySelector('.modal-block-add-item__form').addEventListener('submit', (e) => {
			e.preventDefault();
			let title = e.target.querySelector('.modal-block-add-item__form__title').value;
			let description = e.target.querySelector('.modal-block-add-item__form__description').value;

			xhttp.onreadystatechange = function () {
				if (this.readyState === 4 && this.status === 200) {
					let responseData = JSON.parse(this.responseText);
					console.log(responseData);

					if (responseData.status === 200) {
						alert('Данные добавлены успешно!')
						location.reload();
					}
				}
			}

			let dataForm = `name=${title}&description=${description}`
			let parent = document.querySelector('#ch_id').value;

			if (parent) {
				dataForm += `&parent=${parent}`
				document.querySelector('#ch_id').value = null;
			}

			xhttp.open("GET", `http://localhost/?action=add&${dataForm}`, true);
			xhttp.send();
			e.target.reset();
			e.target.parentNode.style.display = 'none';
		});

		document.querySelector('.modal-block-add-item img').addEventListener('click', (e) => {
			e.target.parentNode.style.display = 'none';
		});
	}

	if (document.querySelectorAll('.delete-item-block') !== null) {
		const deleteElements = document.querySelectorAll('.delete-item-block');
		deleteElements.forEach(element => {
			element.addEventListener('click', (e) => {
				let elementId = e.target.dataset.deleteId;

				xhttp.onreadystatechange = function () {

					if (this.readyState === 4 && this.status === 200) {
						let responseData = JSON.parse(this.responseText);
						console.log(responseData);

						if (responseData.status === 200) {
							alert('Удалено!')
						}
					}
				}

				if (e.target.parentNode.parentNode.dataset.parentId !== undefined) {
					e.target.parentNode.parentNode.remove();
				}

				e.target.parentNode.parentNode.style.display = 'none';
				xhttp.open("GET", `http://localhost/?action=delete&id=${elementId}`, true);
				xhttp.send();
			});
		})
	}

	if (document.querySelector('.update-item-block') !== null) {
		document.querySelectorAll('.update-item-block').forEach(element => {
			element.addEventListener('click', (e) => {
				xhttp.onreadystatechange = function () {
					if (this.readyState === 4 && this.status === 200) {
						let responseData = JSON.parse(this.responseText);

						if (responseData.status === 200) {
							alert('Данные обновлены успешно')
						} else {
							alert('Произошла ошибка')
						}
					}
				}

				let elementId = e.target.dataset.id;
				let queryData = `id=${elementId}&`;
				let name = e.target.parentNode.parentNode.querySelector('#title').value;
				let description = e.target.parentNode.parentNode.querySelector('#description').value;
				//console.log(e.target.parentNode.parentNode);
				
				if (name !== '') {
					queryData += `name=${name}&`;
				}

				if (description !== '') {
					queryData += `description=${description}`;
				}

				xhttp.open("GET", `http://localhost/?action=update&${queryData}`, true);
				xhttp.send();
			})
		});
	}

	if (document.querySelector('.show_childrens') !== null) {
		let showChildrens = document.querySelectorAll('.show_childrens');
		showChildrens.forEach(element => {
			element.addEventListener('click', (e) => {
				console.log(e.target);
			})
		})
	}

	var ele = document.querySelectorAll('[data-parent-id]');
	ele.forEach(el => {
		el.style.display = "none";
	})

	let elements1 = document.querySelectorAll('.show-elements-admin');
	elements1.forEach(element => {
		element.addEventListener('click', (e) => {
			let idItems = e.target.dataset.showChParents;
			let items = document.querySelectorAll('[data-parent-id]');

			items.forEach(item => {
				if (item.dataset.parentId === idItems) {
					item.classList.toggle('showElement')
				}

				// if (e.target.dataset.patentId === idItems) {
				// 	console.log(e.target)
				// }
			})
		})
	});

	if (document.querySelector('.login-form') !== null) {
		document.querySelector('.login-form form').addEventListener('submit', (e) => {
			e.preventDefault();
			xhttp.onreadystatechange = function () {

				if (this.readyState === 4 && this.status === 200) {
					let responseData = JSON.parse(this.responseText);

					if (responseData.status === 200) {
						alert('Авторизация прошла успешно');
						window.location.href = "http://localhost/?page=admin";
					} else {
						alert('Логин или пароль неверные');
					}
				}
			}

			let username = e.target.querySelector('#username').value;
			let password = e.target.querySelector('#password').value;

			xhttp.open("GET", `http://localhost/?action=login&username=${username}&password=${password}`, true);
			xhttp.send();
		});
	};

	if (document.querySelector('.logout')) {
		document.querySelector('.logout').addEventListener('click', () => {
			xhttp.onreadystatechange = function () {
				if (this.readyState === 4 && this.status === 200) {
					let responseData = JSON.parse(this.responseText);
				}
			}

			xhttp.open("GET", `http://localhost/?action=logout`, true);
			xhttp.send();
			window.location.href = "http://localhost/?page=login";
		})
	}


});