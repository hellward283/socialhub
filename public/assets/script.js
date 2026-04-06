function addComment(postId) {

let comment = document.getElementById("comment-" + postId).value;

fetch("add_comment.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"post_id="+postId+"&comment="+encodeURIComponent(comment)
})
.then(()=>location.reload());
}


function editComment(id){

let text=document.getElementById("comment-text-"+id).innerText;

let newText=prompt("Edit comment:",text);

fetch("edit_comment.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"id="+id+"&comment="+encodeURIComponent(newText)
})
.then(()=>location.reload());
}


function deleteComment(id){

if(confirm("Delete comment?")){

fetch("delete_comment.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"id="+id
})
.then(()=>location.reload());

}

}


function likePost(postId){

fetch("like_post.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"post_id="+postId
})
.then(()=>updateLikes(postId));

}


function updateLikes(postId){

fetch("get_likes.php?post_id="+postId)
.then(res=>res.text())
.then(count=>{
document.getElementById("like-count-"+postId).innerText=count;
});

}