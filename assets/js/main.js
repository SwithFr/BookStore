window.addEventListener("scroll",init,false);

function init(){
    var nav = document.getElementById("nav");
    var content = document.getElementById("content");
    var title = document.getElementById("main__title");
    if(window.pageYOffset>=380){
        nav.style.position = 'fixed';
        nav.style.top = nav.style.right = nav.style.left = 0;
        nav.style.backgroundColor = '#fff';
        nav.style.zIndex = 1000;
        content.style.marginTop = '80px';
        title.style.fontSize = ".8em";
        title.style.paddingTop = ".8em";
    }else{
        nav.style.position = 'relative';
        nav.style.backgroundColor = 'none';
        content.style.marginTop = 0;
        title.style.fontSize = "1em";
        title.style.paddingTop = "0";
    }

}