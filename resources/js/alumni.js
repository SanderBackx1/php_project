$(function(){
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    });
});

export function footer(ontwerper, tester){
    $('.footerItem')[ontwerper].append(' (O) ')
    $('.footerItem')[tester].append(' (T) ')
}

export function summary(){
    setTimeout(()=>{
        $('.summary').addClass('fade');
        setTimeout(()=>{
            $('.summary').css('display', 'none');
        },1000)
    }, 5000);
}
