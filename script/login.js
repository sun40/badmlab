//При нажатии на форму ввода логина, убирает введенный текст
function focusLogin(frm){
		frm.auth_name.value = "";
		}

//При нажатии на форму ввода пароля, убирает введенный текст
function focusPassword(frm){
		frm.auth_pass.value = "";
	}

//Проверка ввел ли пользователь какие-то данные формы
// если нет - тогда показывает сообщение об ошибке
function validate(frm){
	var userName = frm.auth_name.value;
	var password = frm.auth_pass.value;

    //Если длина логина равна нулю либо "Имя пользователя", то пользователь не ввел логин
	if ((userName.length === 0) || (userName === "Имя пользователя")) {
		alert("Введите имя пользователя!");
 		return false;
	}

    //Если длина пароля равна нулю либо "password", то пользователь не ввел пароль
	if ((password.length === 0) || (password === "password")) {
		alert("Введите пароль!");
		return false;
	}
	
 	return true;
}