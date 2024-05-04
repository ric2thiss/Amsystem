<?php


function get_all_post() {


    $posts = getAllPost_published();


    if ($posts) {

        foreach ($posts as $post) {
   
            $accountname = get_account_name($post["USERID"]);
            
            // Render the post HTML
            echo '
            <div class="card mb-4 p-4">
                <p style="font-size:11px;text-decoration: underline;">Posted by: <strong style="text-transform: uppercase;">'.$accountname.'</strong></p>
                <p style="font-size:9px; margin-top : -1rem;">'.$post['post_date'].'</p>
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
