function checkReg(frm){
	var login = frm.login.value;
	var email = frm.email.value;
	var email_rep = frm.email_rep.value;
	var pass = frm.pass.value;
	var pass_rep = frm.pass_rep.value;
	var errorMsg = "При заполнении формы допущены следующие ошибки:\n\n";
	var error = {
		1 : "Введите логин",
		2 : "Введите e-mail",
		3 : "Повторите e-mail",
		4 : "Введите пароль",
		5 : "Повторите пароль",
		6 : "Пароль слишком короткий (мин. 6 символов)",
		7 : "Неверный формат почты",
		8 : "В логине допускаются только латинские символы",
		9 : "Пароли не совпадают",
		10 : "Почтовые адреса не совпадают"
		}
	var errorList = [];
	var reg_email = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var reg_login = /[а-яёЁ]/i;
	
	
	if (login == "")													errorList.push(1);
	if (email == "") 													errorList.push(2);
	if (email_rep == "") 											errorList.push(3);
	if (pass == "") 													errorList.push(4);
	if (pass_rep == "") 												errorList.push(5);
	if ((pass.length < 6) || (pass_rep < 6))					errorList.push(6);
	if (!reg_email.test(email))									errorList.push(7);
	if (reg_login.test(login))										errorList.push(8);
	if (pass != pass_rep)											errorList.push(9);
	if (email != email_rep)											errorList.push(10);
	
	
	if (errorList.length > 0){
		var e = "";
		for(i = 0; i < errorList.length; i++){
			e += error[errorList[i]] + "\n";
			}
		alert(errorMsg + e);
		return false;
		}
	
	return true;
	}
	
	