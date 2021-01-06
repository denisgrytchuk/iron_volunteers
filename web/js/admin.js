window.onload = function(){
    var black = $('.black_list');
    var text = $('.black_name');
    for(var i=0;i<black.length;i++){
        var array =text.eq(i).text();
        if(array == 1){
            $('.black_list').eq(i).css(
                {
                    'background': '#d93442',
                    'background-image': 'linear-gradient(to bottom, #d93442, #940000)',
                    'border-radius': '18px',
                    'text-shadow': '1px 1px 2px #0d0b0d',
                    'font-family': 'Arial',
                    'color': '#ffffff',
                    'font-size': '13px',
                    'padding': '2px 4px 2px 4px',
                    'text-decoration': 'none'
                });
        }else{
            $('.black_list').eq(i).css(
                {
                    'background': '#34d934',
                    'background-image': 'linear-gradient(to bottom, #34d934, #175c19)',
                    'border-radius': '18px',
                    'text-shadow': '1px 1px 2px #0d0b0d',
                    'font-family': 'Arial',
                    'color': '#ffffff',
                    'font-size': '13px',
                    'padding': '2px 4px 2px 4px',
                    'text-decoration': 'none'
                });
        }
    }
    var access = $('.access');
    var text = $('.access_name');
    for(var i=0;i<access.length;i++){
        var array =text.eq(i).text();
        if(array == 0){
            $('.access').eq(i).css(
                {
                    'background': '#d93442',
                    'background-image': 'linear-gradient(to bottom, #d93442, #940000)',
                    'border-radius': '18px',
                    'text-shadow': '1px 1px 2px #0d0b0d',
                    'font-family': 'Arial',
                    'color': '#ffffff',
                    'font-size': '13px',
                    'padding': '2px 4px 2px 4px',
                    'text-decoration': 'none'
                });
        }else{
            $('.access').eq(i).css(
                {
                    'background': '#34d934',
                    'background-image': 'linear-gradient(to bottom, #34d934, #175c19)',
                    'border-radius': '18px',
                    'text-shadow': '1px 1px 2px #0d0b0d',
                    'font-family': 'Arial',
                    'color': '#ffffff',
                    'font-size': '13px',
                    'padding': '2px 4px 2px 4px',
                    'text-decoration': 'none'
                });
        }
    }
    var button = $('.packet_button');
    for(var i=0;i<button.length;i++){
        if($('.packet_status').eq(i).text()==1){
            button.eq(i).text('Видалити даний атрибут в пакета');
        }else{
            button.eq(i).text('Додати даний атрибут в пакет');
        }
    }
}



$('.black_list').on('click',function () {
        var btn_id = this.id;
        var index = this.name;
        var black = $('.black_name').eq(index).text();
        var data = {'idUser':btn_id,'black':1};
        $.ajax({
            url: '/admin/volunteers/',
            type: 'POST',
            data: data,
            success: function(res){
                if(black==1){
                    $('.black_list').eq(index).css(
                        {
                            'background': '#34d934',
                            'background-image': 'linear-gradient(to bottom, #34d934, #175c19)',
                            'border-radius': '18px',
                            'text-shadow': '1px 1px 2px #0d0b0d',
                            'font-family': 'Arial',
                            'color': '#ffffff',
                            'font-size': '13px',
                            'padding': '2px 4px 2px 4px',
                            'text-decoration': 'none'
                        });
                    $('.black_name').eq(index).text("0");

                }
                if(black==0){
                    $('.black_list').eq(index).css(
                        {
                            'background': '#d93442',
                            'background-image': 'linear-gradient(to bottom, #d93442, #940000)',
                            'border-radius': '18px',
                            'text-shadow': '1px 1px 2px #0d0b0d',
                            'font-family': 'Arial',
                            'color': '#ffffff',
                            'font-size': '13px',
                            'padding': '2px 4px 2px 4px',
                            'text-decoration': 'none'
                        });
                    $('.black_name').eq(index).text("1");

                }
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);

$('.access').on('click',function () {
        var btn_id = this.id;
        var index = this.name;
        var access = $('.access_name').eq(index).text();
        var data = {'idUser':btn_id,'black':0};
        $.ajax({
            url: '/admin/volunteers/',
            type: 'POST',
            data: data,
            success: function(res){
                if(access==0){
                    $('.access').eq(index).css(
                        {
                            'background': '#34d934',
                            'background-image': 'linear-gradient(to bottom, #34d934, #175c19)',
                            'border-radius': '18px',
                            'text-shadow': '1px 1px 2px #0d0b0d',
                            'font-family': 'Arial',
                            'color': '#ffffff',
                            'font-size': '13px',
                            'padding': '2px 4px 2px 4px',
                            'text-decoration': 'none'
                        });
                    $('.access_name').eq(index).text("1");

                }
                if(access==1){
                    $('.access').eq(index).css(
                        {
                            'background': '#d93442',
                            'background-image': 'linear-gradient(to bottom, #d93442, #940000)',
                            'border-radius': '18px',
                            'text-shadow': '1px 1px 2px #0d0b0d',
                            'font-family': 'Arial',
                            'color': '#ffffff',
                            'font-size': '13px',
                            'padding': '2px 4px 2px 4px',
                            'text-decoration': 'none'
                        });
                    $('.access_name').eq(index).text("0");

                }
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);

$('.packet_button').on('click',function () {
        var index = this.id;
        var btn_id = $('.packet_id').eq(index).text();
        var data = {'idPacket':btn_id};
        var idEvent = this.name;
        var status = $('.packet_status').eq(index).text();
        //console.log(index);
        $.ajax({
            url: '/admin/event/packet?id='+idEvent,
            type: 'POST',
            data: data,
            success: function(res){
                if(status==0){
                    $('.packet_button').eq(index).text("Видалити даний атрибут в пакета");

                }
                if(status==1){
                    $('.packet_button').eq(index).text("Додати даний атрибут в пакет");

                }
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    }
);
