window.onload = function(){
	var call = $('.default_role');	
	var arr = $('.array').text();	
	
	var arr = arr.split('/');
	//console.log(arr);
	var numbers = arr.length;	
	//var option = $(".target[id=0]");
	for(var i=0;i<call.length;i++){
		var options = $(".target[id="+i+"]");
		var status= call.eq(i).text();	
		for(var j=0;j<numbers;j++){
			if(status==arr[j]){
				options.val(j+2).attr("selected", "selected");
			}
		}
	}
}

$('.target').on('change',function () {
        var index = this.id;
        var part = $('.part_id').eq(index).text();
		var status = $('.target option:selected').eq(index).text();
		var idEvent = $('.id_event').text();
		var ended_role=status;
        var data = {'part':part,'ended_role':ended_role};
        $.ajax({
            url: '/ring/acept?id='+idEvent,
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
