let mainPostBtn = document.getElementById('btn-post');
let mainPostContinue = document.getElementById('post-continue-for-API');

let API_btn = document.querySelector('.API-btn');


if (mainPostBtn) {
mainPostBtn.addEventListener('click', function () {
    let Request = new XMLHttpRequest();
    Request.open('GET', 'https://bestshop.local/wp-json/wp/v2/Product' );
    Request.onload = function () {
        if( Request.status >= 200 && Request.status < 400 ) {

            let data = JSON.parse( Request.responseText );
            CreateHTML(data)
            API_btn.remove();
            console.log(data);

        } else {
            console.log('We connected to the server, but it returned an error! 😒')
        }
    };

    Request.onerror = function () {
        console.log('Connecting Error');
    }

    Request.send();
});

// HTML
function CreateHTML( postData ) {
    let myHTMLString = '';

    for (let i = 0; i < postData.length; i++) {
        myHTMLString += '<div class="post-content-main"><h2>' + postData[i].title.rendered + '</h2>' + postData[i].content.rendered + '</div>';
    }

    mainPostContinue.innerHTML =  myHTMLString;
}
}



// Quick Add Post AJAX
let addPostNew = document.querySelector('#add_posts_btn');

if (addPostNew) {
addPostNew.addEventListener('click',
    function () {

        let ourPost = {

            "title": document.querySelector(".post-all [name='title']").value,
            "content": document.querySelector(".post-all [name='content']").value,
            "status": "publish"
        }

        let creatNewPost = new XMLHttpRequest();
        creatNewPost.open('POST', magicalData.siteURL + '/wp-json/wp/v2/posts');
        creatNewPost.setRequestHeader("X-WP-Nonce", magicalData.nonce);
        creatNewPost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        creatNewPost.send(JSON.stringify(ourPost));
        creatNewPost.onreadystatechange = function () {
            if (creatNewPost.readyState == 4) {
                if (creatNewPost.status == 201) {
                    document.querySelector(".post-all [name='title']").value = ''
                    document.querySelector(".post-all [name='content']").value = ''
                } else {
                    alert("Error - try Again !")
                }
            }
        }
    });
}


