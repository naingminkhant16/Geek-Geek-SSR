window.makeRequestForPostLike = function (_token, post_id,user_id) {
    const url = `http://127.0.0.1:8000/posts/like/${post_id}/${user_id}`

    fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: "same-origin",
        })
        .then((response) => {
            if (response.status === 200) {
                return response.json()
            }
        })
        .then(res => {
            //get to change icon on ui
            const heartSign = document.getElementsByClassName(`heart-sign-${post_id}`)[0]
            //get to change likes count on ui
            const likesCount = document.getElementById(`likes-count-${post_id}`)

            if (res.msg === "like") {
                heartSign.classList.remove('bi-heart')
                heartSign.classList.add('bi-heart-fill')
                heartSign.classList.add('text-danger')
                likesCount.innerHTML = parseInt(likesCount.innerHTML) + 1
            } else if (res.msg === 'unlike') {
                heartSign.classList.remove('bi-heart-fill')
                heartSign.classList.add('bi-heart')
                heartSign.classList.remove('text-danger')

                likesCount.innerHTML = parseInt(likesCount.innerHTML) - 1
            }
        })
        .catch(err => console.log(err))
}
