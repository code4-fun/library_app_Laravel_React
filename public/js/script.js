$(document).ready(function(){
  $('.alert-dismissible').fadeTo(2000, 500).slideUp(500, function(){
    $('.alert-dismissible').alert('close')
  })
})

// category dropdown handler
$(document).on('click', '.calendar_category_filter_item', function(e){
  $('#search_book_input').val('')
  $('#calendar_category_filter').text($(this).text())
  e.preventDefault()
  let url = '/book/' + $(this).data('slug')
  getBooks(url)
  window.history.pushState("", "", url)
})
$(document).on('show.bs.dropdown', '#category_dropdown_filter', function () {
  $('#calendar_category_filter').toggleClass('filter_arrow_up')
})
$(document).on('hide.bs.dropdown', '#category_dropdown_filter', function () {
  $('#calendar_category_filter').toggleClass('filter_arrow_up')
})

$(document).on('click', '.pagination a', function(e) {
  e.preventDefault()
  let urlParams = new URLSearchParams(window.location.search)
  let url = urlParams.has('search') ? $(this).attr('href') + '&search=' + urlParams.get('search') : $(this).attr('href')
  getBooks(url)
  window.history.pushState("", "", url)
});

function getBooks(url) {
  $.ajax({
    url : url
  }).done(function(data){
    $('.row').html(data)
  })
}

// search text array input handler
let searchTimer;
$('#search_book_input').on('input', function(){
  console.log('here')
  clearTimeout(searchTimer)
  searchTimer = setTimeout(() => {
    let url = 'http://127.0.0.1:8000?search=' + $(this).val()
    getBooks(url)
    $('#calendar_category_filter').text('Все')
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