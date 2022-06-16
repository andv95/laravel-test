function httpGetAsync(theUrl, callback) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) callback(xmlHttp);
    }
    xmlHttp.open("GET", theUrl, true)
    xmlHttp.send(null);
}
//Normal function
function handleNormalFunction() {
    httpGetAsync('https://picsum.photos/400/400', (data) => {
        console.log(data);
        document.getElementById("img_1").setAttribute("src", data.responseURL);
        httpGetAsync('https://picsum.photos/400/400', (data) => {
            document.getElementById("img_2").setAttribute("src", data.responseURL);

            httpGetAsync('https://picsum.photos/400/400', (data) => {
                document.getElementById("img_3").setAttribute("src", data.responseURL);
            })
        })
    });
}
//Promise
function handlePromise() {
    // Promise khai báo 1 object với than số là 1 callback function với 2 tham số là resolve và reject
    const currentPromise = new Promise((resolve, reject) => {
        let condition = true;
        if (condition) {
            httpGetAsync('https://picsum.photos/400/400', resolve);
        }
        else {
            reject('Promise Errored');
        }
    });

    const promise2 = new Promise((resolve, reject) => {
        httpGetAsync('https://picsum.photos/400/400', resolve);
    });

    const promise3 = new Promise((resolve, reject) => {
        httpGetAsync('https://picsum.photos/400/400', resolve);
    });

    currentPromise
        .then((data) => {
            document.getElementById("img_4").setAttribute("src", data.responseURL);

            return promise2;
        })
        .then((data) => {
            document.getElementById("img_5").setAttribute("src", data.responseURL);

            return promise3;
        })
        .then((data) => {
            document.getElementById("img_6").setAttribute("src", data.responseURL);
        })

        .catch((err) => {
            console.log(err);
        })
}
//Async Await
function handleAsync() {
    const promise4 = new Promise((resolve, reject) => {
        httpGetAsync('https://picsum.photos/400/400', resolve);
    });

    const promise5 = new Promise((resolve, reject) => {
        httpGetAsync('https://picsum.photos/400/400', resolve);
    });

    const promise6 = new Promise((resolve, reject) => {
        httpGetAsync('https://picsum.photos/400/400', resolve);
    });

    const executeAsync = async function() {
        try {
            const response = await promise4;
            document.getElementById("img_7").setAttribute("src", response.responseURL);

            const response2 = await promise5;
            document.getElementById("img_8").setAttribute("src", response2.responseURL);

            const response3 = await promise6;
            document.getElementById("img_9").setAttribute("src", response3.responseURL);
        } catch (err) {
            console.log({err});
        }
    };

    executeAsync();
}

// handleAsync();
// handleNormalFunction();
handlePromise();

