<?php


function get_all_post() {
    // Retrieve user data
    $userData = get_account_all_information($_SESSION["user_id"]);


    $posts = getAllPost_published();


    if ($posts) {

        foreach ($posts as $post) {
   
            $accountname = get_account_name($post["USERID"]);
            
            // Render the post HTML
            echo '
            <div class="card mb-4">
                <p style="font-size:11px;">Posted by: <strong style="text-transform: uppercase;">'.$accountname.'</strong></p>
                <div class="card-body">
                    <h5 class="card-title"> '.$post['POST_TITLE'].'</h5>
                    <p class="card-text">'.$post['POST_DESCRIPTION'].'</p>
                </div>
            </div>';
        }
    } else {
        echo "No published posts found.";
    }
}
?>
