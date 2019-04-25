
let paginatePage = 1;

//if click on Filter button
$('#filter').on('submit', function (e) {

    e.preventDefault();
    paginatePage = $('.current-link').text();

    do_ajax_query();
});


//if click on pagination buttons
$('a#pag-link').on('click', function () {
    paginatePage = $(this).data('field');
    let allPages = $('div#all-pages').data('pages');

    let currentPage = $(this).data('field');
    let prevPage = currentPage - 1;
    let nextPage = currentPage + 1;

    //if have next or previous pages user can click links
    if ($(this).hasClass('prev-link')) {
        $('.next-link').css("pointer-events", "auto");
        $('.last-link').css("pointer-events", "auto");
    } else {
        $('.prev-link').css("pointer-events", "auto");
        $('.first-link').css("pointer-events", "auto");
    }

    //Otherwise can't
    $('.current-link').text(currentPage);
    $('.next-link').data('field', nextPage);
    $('.prev-link').data('field', prevPage);
    if (allPages < nextPage) {
        $('.next-link').css("pointer-events", "none");
        $('.last-link').css("pointer-events", "none");
    }
    if (prevPage < 1) {
        $('.prev-link').css("pointer-events", "none");
        $('.first-link').css("pointer-events", "none");
    }

    do_ajax_query();
});

//main ajax query
function do_ajax_query(){
    //get all inputs from filter
    let id = $('input[name=id]').val();
    let string_field = $('input[name=string_field]').val();
    let boolean_field = $('#boolean_field option:selected').val();
    let decimal_field = $('input[name=decimal_field]').val();
    let timestamp_field_from = $('input[name=timestamp_field_from]').val();
    let timestamp_field_to = $('input[name=timestamp_field_to]').val();
    let order_by = $('#order_by option:selected').val();
    let sort_order = $('#sort_order option:selected').val();


    $.ajax({
        type: "GET",
        url: "/filter-fields",

        data: "id=" + id + '&string_field=' + string_field + '&boolean_field=' + boolean_field + '&decimal_field='
        + decimal_field + '&timestamp_field_from=' + timestamp_field_from + '&timestamp_field_to=' + timestamp_field_to
        + '&order_by=' + order_by + '&sort_order=' + sort_order + '&current_page=' + paginatePage,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            //added inputs to url
            history.pushState(null, '', '/?id=' + id + '&string_field=' + string_field + '&boolean_field=' + boolean_field + '&decimal_field='
                + decimal_field + '&timestamp_field_from=' + timestamp_field_from + '&timestamp_field_to=' + timestamp_field_to
                + '&order_by=' + order_by + '&sort_order=' + sort_order + '&current_page=' + paginatePage);

            $('.for-ajax').html(data);
            let allPages = $('div#all-pages');

            //set last page for pagination link
            $('.last-link').data('field', allPages.data('pages'));
            //block or unblock pagination links
            if (allPages.data('pages') <= 1 || $('.current-link').text() >= allPages.data('pages')) {
                $('.next-link').css("pointer-events", "none");
                $('.last-link').css("pointer-events", "none");
            } else {
                $('.next-link').css("pointer-events", "auto");
                $('.last-link').css("pointer-events", "auto");
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            alert('Something went wrong');
        }

    });
}