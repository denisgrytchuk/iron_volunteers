$('.btn_etap').on('click',function () {
    var index = this.id;
    var div = $('.hidden_div').eq(index);
    var textarea = $('.hidden_textarea').eq(index);
    console.log(textarea.is(':hidden'));
    if (textarea.is(':hidden')) {
        div.show();
        textarea.show();
        $('.btn_etap').eq(index).text("Відмовитись");
        $('.btn_etap').eq(index).css({'backgroundColor': 'red'});
    }
    else {
        div.hide();
        textarea.hide();
        $('.btn_etap').eq(index).text("Взяти участь");
        $('.btn_etap').eq(index).css({'backgroundColor': 'green'});
    }

});