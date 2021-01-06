
$('.cancel_event').on('click',function(){
	var index = this.id;
	var idParticipation = $('.event_id').eq(index).text();
	var data = {'idParticipation':idParticipation};
        $.ajax({
            url: '/cabinet',
            type: 'POST',
            data: data,
            success: function(res){
				$('.hidden_event').eq(index).hide();
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
});

$('.cancel_etap').on('click',function(){
	var index = this.id;
	var idEtap = $('.etap_id').eq(index).text();
	var data = {'idEtap':idEtap};
        $.ajax({
            url: '/cabinet',
            type: 'POST',
            data: data,
            success: function(res){
			$('.hidden_etap').eq(index).hide();
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
});