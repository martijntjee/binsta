function toggleComments(postId) {
    const commentsContainer = document.getElementById("comments" + postId);
    const commentsButton = document.getElementById("commentsButton" + postId);
    // change the text of the button to "Hide comments"
    if (commentsContainer.classList.contains("hidden")) {
        commentsButton.innerText = "Hide comments";
    } else {
        commentsButton.innerText = "View comments";
    }

    commentsContainer.classList.toggle("hidden");
}
