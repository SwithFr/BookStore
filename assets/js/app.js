// Generated by CoffeeScript 1.9.2
(function() {
  'use strict';
  var addReadLaterLink, fadeOut, removeReadLaterLink, setReadLater;

  window.addEventListener("scroll", function() {
    var content, nav, title;
    nav = document.getElementById("nav");
    content = document.getElementById("content");
    title = document.getElementById("main__title");
    if (window.pageYOffset >= 380) {
      nav.style.position = 'fixed';
      nav.style.top = nav.style.right = nav.style.left = 0;
      nav.style.backgroundColor = '#fff';
      nav.style.zIndex = 1000;
      content.style.marginTop = '80px';
      title.style.fontSize = ".8em";
      return title.style.paddingTop = ".8em";
    } else {
      nav.style.position = 'relative';
      nav.style.backgroundColor = 'none';
      content.style.marginTop = 0;
      title.style.fontSize = "1em";
      return title.style.paddingTop = "0";
    }
  }, false);

  if (document.getElementById("alert")) {
    document.getElementById("alert").addEventListener("click", function(e) {
      return fadeOut(e, false);
    });
  }

  fadeOut = function(e) {
    e.preventDefault();
    e.target.style.opacity = 0;
    return setTimeout(function() {
      return e.target.style.display = 'none';
    }, 300);
  };

  addReadLaterLink = document.querySelector('#addReadLaterLink');

  removeReadLaterLink = document.querySelector('#removeReadLaterLink');

  addReadLaterLink.addEventListener("click", function(e) {
    return setReadLater(e);
  }, false);

  removeReadLaterLink.addEventListener("click", function(e) {
    return setReadLater(e);
  }, false);

  setReadLater = function(e) {
    var book_id, data, request, url, user_id;
    e.preventDefault();
    url = e.target.href;
    console.log(url);
    user_id = e.target.dataset.user_id;
    book_id = e.target.dataset.book_id;
    request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.onreadystatechange = function() {
      if (this.status === 200) {
        if (e.target.id === 'addReadLaterLink') {
          addReadLaterLink.className = 'hidden';
          return removeReadLaterLink.className = 'visible';
        } else if (e.target.id === 'removeReadLaterLink') {
          addReadLaterLink.className = 'visible';
          return removeReadLaterLink.className = 'hidden';
        }
      }
    };
    data = 'user_id=' + user_id + '&book_id=' + book_id;
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    return request.send(data);
  };

}).call(this);

//# sourceMappingURL=app.js.map
