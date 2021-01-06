

$('.edit').on('click',function () {
    //alert(this.name);
    var array = $('.ind');
    var array2 = $('.name');
    var index;
    //console.log($('.ind')[2]);
    //console.log(array[2].value);
    for (var i = 0; i < array.length; i++) {
        if (array[i].innerText == this.name) {
            array2[i].innerText = prompt('Введіть назву категорії', array2[i].innerText);
            index = i;
            break;
        }

    }
    /*$.post("/admin/category/",
        {
            'new_category': array2[index].innerText,
            'new_id': array[index].innerText
        }
    )*/
    $.ajax({
        type: 'get',
        url: '/admin/category/',
        data: {
            'new_category': array2[index].innerText,
            'new_id': array[index].innerText
        }
    }).done(function() {
        console.log('success');
    }).fail(function() {
        console.log('fail');
    });
});



