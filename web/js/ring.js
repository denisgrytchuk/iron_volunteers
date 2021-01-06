window.onload = function(){
	var call = $('.default_call');	
	for(var i=0;i<call.length;i++){
		var options = $(".target1[id="+i+"]");
		var status= call.eq(i).text();	
		switch(status){
			case 'Підтверджено' :
				options.val('2').attr("selected", "selected");
				break;
			case 'Відмова' :
				options.val('3').attr("selected", "selected");
				break;
			case 'Передзвонити' :
				options.val('4').attr("selected", "selected");
				break;
			case 'Відсутній зв\'язок' :
				options.val('5').attr("selected", "selected");
				break;
			case 'Невірний номер' :
				options.val('6').attr("selected", "selected");
				break;
			default :
				options.val('1').attr("selected", "selected");
				break;
			
			
		}
	}
	var call = $('.default_event');	
	for(var i=0;i<call.length;i++){
		var options = $(".target2[id="+i+"]");
		var status= call.eq(i).text();	
		switch(status){
			case 'Неявка' :
				options.val('2').attr("selected", "selected");
				break;
			case 'Захворів' :
				options.val('3').attr("selected", "selected");
				break;
			case 'Волонтерив' :
				options.val('4').attr("selected", "selected");
				break;
			case 'Активіст' :
				options.val('5').attr("selected", "selected");
				break;
			default :
				options.val('1').attr("selected", "selected");
				break;
			
			
		}
	}
	var call = $('.default_etap');	
	for(var i=0;i<call.length;i++){
		var options = $(".target3[id="+i+"]");
		var status= call.eq(i).text();	
		switch(status){
			case 'Неявка' :
				options.val('2').attr("selected", "selected");
				break;
			case 'Захворів' :
				options.val('3').attr("selected", "selected");
				break;
			case 'Волонтерив' :
				options.val('4').attr("selected", "selected");
				break;
			case 'Активіст' :
				options.val('5').attr("selected", "selected");
				break;
			default :
				options.val('1').attr("selected", "selected");
				break;
			
			
		}
	}
}



$('.target1').on('change',function () {
        var index = this.id;
        var user = $('.part_call').eq(index).text();
		var status = $('.target1 option:selected').eq(index).val();
		var idEvent = $('.id_event').text();
		var participation_call="";
		switch(status){
			case '2' :
				participation_call = "Підтверджено";
				break;
			case '3' :
				participation_call = "Відмова";
				break;
			case '4' :
				participation_call = "Передзвонити";
				break;
			case '5' :
				participation_call = "Відсутній зв\'язок";
				break;
			case '6' :
				participation_call = "Невірний номер";
				break;
			default :
				participation_call = "";
				break;
		}
        var data = {'user':user,'participation_call':participation_call};
        $.ajax({
            url: '/ring/view?id='+idEvent,
            type: 'POST',
            data: data,
            success: function(res){

                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);

$('.target2').on('change',function () {
        var index = this.id;
        var user = $('.part_call').eq(index).text();
		var status = $('.target2 option:selected').eq(index).val();
		var idEvent = $('.id_event').text();
		var participation_event="";
		switch(status){
			case '2' :
				participation_event = "Неявка";
				break;
			case '3' :
				participation_event = "Захворів";
				break;
			case '4' :
				participation_event = "Волонтерив";
				break;
			case '5' :
				participation_event = "Активіст";
				break;
			default :
				participation_event = "";
				break;
		}
        var data = {'user':user,'participation_event':participation_event};
        $.ajax({
            url: '/ring/view?id='+idEvent,
            type: 'POST',
            data: data,
            success: function(res){

                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);

$('.target3').on('change',function () {
        var index = this.id;
        var etap = $('.etap_status').eq(index).text();
		var status = $('.target3 option:selected').eq(index).val();
		var idEvent = $('.id_event').text();
		var etap_status="";
		switch(status){
			case '2' :
				etap_status = "Неявка";
				break;
			case '3' :
				etap_status = "Захворів";
				break;
			case '4' :
				etap_status = "Волонтерив";
				break;
			case '5' :
				etap_status = "Активіст";
				break;
			default :
				etap_status = "";
				break;
		}
        var data = {'etap':etap,'etap_status':etap_status};
        $.ajax({
            url: '/ring/view?id='+idEvent,
            type: 'POST',
            data: data,
            success: function(res){

                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);