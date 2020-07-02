let mainNav = document.querySelector('[data-js=mainNav]');
let burgerBtn = document.querySelector('[data-js=burgerBtn]');

if (mainNav) {
	burgerBtn.addEventListener('click', () => {
		if (mainNav.className === "header__menu") {
			mainNav.className += " header__responsive";
		} else {
			mainNav.className = "header__menu";
		}
	});
}

let menuChildren = document.getElementsByClassName('menu-item-has-children');

if (menuChildren) {
	for (let i = 0; i < menuChildren.length; i += 1) {
		menuChildren[i].addEventListener('click', () => {
			if (menuChildren[i].classList.contains("expanded")) {
				menuChildren[i].classList.remove("expanded");
			} else {
				menuChildren[i].className += " expanded";
			}
		});
	}
}
