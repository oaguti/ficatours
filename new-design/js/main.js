(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    
})(jQuery);

document.addEventListener('DOMContentLoaded', function() {
    const insertData = (data)=>{
        console.log(data);
        data.list.forEach(element => {
            element.innerHTML = data.content
        });
    }
    const getDataEmpresa = JSON.parse(sessionStorage.getItem('dataEmpresa'))
    
    if(getDataEmpresa){
        console.log(getDataEmpresa);
        const firstEmail = document.querySelectorAll('.data-correo1')
        const firstPhone = document.querySelectorAll('.data-telefono1')
        const address = document.querySelectorAll('.data-direccion')

        insertData({list:firstEmail,content:getDataEmpresa[0].email})
        insertData({list:firstPhone,content:getDataEmpresa[0].telefono})
        insertData({list:address,content:getDataEmpresa[0].direccion})
    }
})

