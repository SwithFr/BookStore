'use strict'

# Fix nav when the page is scrolled
window.addEventListener(
    "scroll",
    () ->
        nav = document.getElementById "nav"
        content = document.getElementById "content"
        title = document.getElementById "main__title"
        if window.pageYOffset >= 380
            nav.style.position = 'fixed'
            nav.style.top = nav.style.right = nav.style.left = 0
            nav.style.backgroundColor = '#fff'
            nav.style.zIndex = 1000
            content.style.marginTop = '80px'
            title.style.fontSize = ".8em"
            title.style.paddingTop = ".8em"
        else
            nav.style.position = 'relative'
            nav.style.backgroundColor = 'none'
            content.style.marginTop = 0
            title.style.fontSize = "1em"
            title.style.paddingTop = "0"
    , false)

# Remove alert box on click
if document.getElementById("alert") then document.getElementById("alert").addEventListener "click", ( e ) -> fadeOut e, false

# Remove alert function
fadeOut = ( e ) ->
    e.preventDefault()
    e.target.style.opacity = 0
    setTimeout(
      () ->
        e.target.style.display = 'none'
      , 300 )

# Ajax read later
addReadLaterLink = document.querySelector '#addReadLaterLink'
removeReadLaterLink = document.querySelector '#removeReadLaterLink'
removeReadLaterLinkFromList = document.querySelectorAll '.removeReadLaterLinkFromList'

if addReadLaterLink
  addReadLaterLink.addEventListener(
      "click",
      ( e ) ->
        setReadLater e
      , false )

if removeReadLaterLink
  removeReadLaterLink.addEventListener(
      "click",
      ( e ) ->
        setReadLater e
      , false )

if removeReadLaterLinkFromList
  for i in removeReadLaterLinkFromList
    i.addEventListener(
      "click",
      ( e ) ->
        setReadLater e, true
      , false )

setReadLater = ( e, fromList = false ) ->
  e.preventDefault()
  url = e.target.href
  user_id = e.target.dataset.user_id
  book_id = e.target.dataset.book_id
  id = e.target.id
  request = new XMLHttpRequest()
  request.open "POST", url, true
  request.onreadystatechange = ->
    if @status is 200 and @readyState == 4
      if !fromList
        if id is 'addReadLaterLink'
          addReadLaterLink.className = 'hidden'
          removeReadLaterLink.className = 'visible'
        else if id is 'removeReadLaterLink'
          addReadLaterLink.className = 'visible'
          removeReadLaterLink.className = 'hidden'
      else
        document.getElementById(book_id).remove()
  data = 'user_id=' + user_id + '&book_id=' + book_id
  request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  request.send data