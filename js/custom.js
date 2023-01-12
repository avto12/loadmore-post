jQuery(function ($) {
    $('#load-more').on('click',  function () {
        let data = {
            'action'    :   'load_posts_by_ajax',
            'paged'     :   load.current_page,
            'query'     :   load.posts,
            'security'  :   load.security,

        };

        $.post(load.ajaxurl, data, function ( response ) {

            if($.trim( response ) !== '' ) {
                $('.post-all').append(response);
                    if(load.current_page >= $('#load-more').attr('max_num_pages')) {
                        $('#load-more').remove();
                    }
                load.current_page++;

            }
        });
    });
 });




// scroll bottom -----------------------------------------------------------------------------;

// jQuery(function ($) {
//
//     let canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
//         bottomOffset = 935; // the distance (in px) from the page bottom when you want to load more posts
//
//
//     console.log($('.post-all'))
//
//     $(window).scroll(function(){
//         let data = {
//             'action': 'load_posts_by_ajax',
//             'query': load.posts,
//             'page' : load.current_page
//         };
//     if($(document).scrollTop() >  ( $(document).height() - bottomOffset ) && canBeLoaded === true ) {
//         let data = {
//             'action': 'load_posts_by_ajax',
//             'paged': load.current_page,
//             'query': load.posts,
//             'security': load.security,
//
//         };
//
//         $.post(load.ajaxurl, data, function (response) {
//             if ($.trim(response) !== '') {
//                 $('.post-all').append(response);
//
//                 if (load.current_page >= $('#load-more').attr('max_num_pages')) {
//                     $('#load-more').remove();
//                 }
//                 load.current_page++
//             }
//         });
//     }
//     });
// });
//



