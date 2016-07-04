function date2day() {
	var dateObj = new Date();
	var dd = dateObj.getDate();
	var mm = dateObj.getMonth()+1; //January is 0!
	var yyyy = dateObj.getFullYear();

	if(dd<10){ dd='0'+dd; } 
	if(mm<10){ mm='0'+mm; } 
	var date = mm+'/'+dd+'/'+yyyy;

	return date;

}

function firstDayOfThisMonth() {
	var dd='01';
	var dateObj = new Date();
	var mm = dateObj.getMonth()+1;
	var yyyy = dateObj.getFullYear();
	if(mm<10){ mm='0'+mm; } 

	var date = mm+'/'+dd+'/'+yyyy;

	return date;

}