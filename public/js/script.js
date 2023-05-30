$(document).ready(function(){
  if(window.location.href.indexOf('/category') != -1) {
    $('.category_dropdown_toggle').text(sessionStorage.getItem('category').substr(sessionStorage.getItem('category').indexOf('<<>>') + 4))
  } else {
    sessionStorage.setItem('category', `all`)
  }

  // slow fade out of bootstrap alerts
  $('.alert-dismissible').fadeTo(2000, 500).slideUp(500, function(){
    $('.alert-dismissible').alert('close')
  })
  // retention of delete books checkboxes and button on page reload
  if(sessionStorage.getItem('delete_books') === 'yes'){
    $('.delete_checkbox').css('display', 'block')
    $('.delete_books_btn').css('display', 'flex')
  }
  // retention of search input on page reload
  if(sessionStorage.getItem('searchString') !== ''){
    $('#search_book_input').val(sessionStorage.getItem('searchString'))
  }
})
// category dropdown handler
$(document).on('click', '.category_filter_item', function(e){
  $('#search_book_input').val('')
  $('.category_dropdown_toggle').text($(this).text())
  sessionStorage.setItem('category', `${$(this).data('slug')}<<>>${$(this).text()}`)
  e.preventDefault()
  let url = '/book/category/' + $(this).data('slug')
  getBooks(url, {
    delete_books: sessionStorage.getItem('delete_books')
  })
  window.history.pushState("", "", url)
})
// category dropdown arrow up/down
$(document).on('show.bs.dropdown', '#category_dropdown_filter', function () {
  $('.category_dropdown_toggle').toggleClass('filter_arrow_up')
})
// category dropdown arrow up/down
$(document).on('hide.bs.dropdown', '#category_dropdown_filter', function () {
  $('.category_dropdown_toggle').toggleClass('filter_arrow_up')
})
// change page handler
$(document).on('click', '.pagination a', function(e) {
  e.preventDefault()
  let urlParams = new URLSearchParams(window.location.search)
  let url = urlParams.has('search') ? $(this).attr('href') + '&search=' + urlParams.get('search') : $(this).attr('href')
  getBooks(url, {
    delete_books: sessionStorage.getItem('delete_books')
  })
  window.history.pushState("", "", url)
});
function getBooks(url, data=null) {
  $.ajax({
    url : url,
    data: data
  }).done(function(data){
    $('.row').html(data)
  })
}
// search handler
let searchTimer;
$('#search_book_input').on('input', function(){
  clearTimeout(searchTimer)
  searchTimer = setTimeout(() => {
    sessionStorage.setItem('searchString', $(this).val())
    let url = 'http://127.0.0.1:8000?search=' + $(this).val()
    getBooks(url, {
      delete_books: sessionStorage.getItem('delete_books')
    })
    $('.category_dropdown_toggle').text('Все')
    window.history.pushState("", "", url)
  }, 1000);
})
// show one book
$('.show_book').on('click', function(){
  let url = '/book/show/' + $(this).data('slug')
  getBooks(url)
  $('#category_filter').hide()
  $('#search_book_input').hide()
  window.history.pushState("", "", url)
})
// append/remove password input in the edit user form
$('#change_password').on('change', function(){
  if($(this).prop('checked')){
    $('.save_employee_button').before(
      `<div class="mb-3" id="password_block">
        <input class="form-control"
               name="password"
               type="text"
               placeholder="Пароль"
               autoComplete="off">
      </div>`
    )
  } else {
    $('#password_block').remove()
  }
})
// show comments
$(document).on('click', '.form-check-input', function(){
  if($(this).is(":checked")){
    $.get(`/book/${$(this).data('slug')}/comments`,
      function(data){
        $('.book_card').after(data)
      }
    )
  } else {
    $('.comments_container').remove()
  }
})
// send comment
$(document).on('click','#comment_button', function(e){
  e.preventDefault()
  $.ajax({
    type:'POST',
    url:`/book/${$(this).data('slug')}/comments`,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:{
      comment_textarea: $('.comment_textarea').val(),
      author: $(this).data('author')
    }
  }).done(function(data) {
    $('.comment_textarea').val('')
    $('#comment_form').after(data)
  }).fail(function(e){
    if (e.status === 422) {
      $.each(e.responseJSON.errors, function (k, v) {
        $('#comment_form').before(
          `<div class="alert alert-danger alert-dismissible fade show col-md-8 mt-2" role="alert">
            ${v[0]}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`
        )
      });
    }
  })
})
// delete multiple books menu. Show/hide checkboxes and delete button
$(document).on('click', '#delete_books', function(){
  if(sessionStorage.getItem('delete_books') === 'yes') {
    sessionStorage.setItem('delete_books', 'no')
    $('.delete_checkbox').css('display', 'none').prop('checked',false)
    $('.delete_books_btn').css('display', 'none')
  } else {
    sessionStorage.setItem('delete_books', 'yes')
    $('.delete_checkbox').css('display', 'block')
    $('.delete_books_btn').css('display', 'flex')
  }
})
// delete multiple books button. Delete selected books from DB, refresh view (no page reload)
$(document).on('click', '.delete_books_btn', function(){
  const ids = []
  $('.delete_checkbox:checkbox:checked').each(function () {
    ids.push($(this).data('id'))
  })
  const current_page = $('.page-link:not([href])').filter(function(){
    return $(this).text() !== '...';
  }).text()
  $.ajax({
    type:'POST',
    url: '/books/delete',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      ids: ids,
      delete_books: sessionStorage.getItem('delete_books'),
      current_page: current_page,
      category: sessionStorage.getItem('category').substring(0, sessionStorage.getItem('category').indexOf('<<>>'))
    }
  }).done(function(data){
    $('.row').html(data)
  })
})
$('.main_link').on('click', function(){
  sessionStorage.setItem('searchString', '')
})
