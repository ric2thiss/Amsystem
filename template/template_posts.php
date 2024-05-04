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

    function get_all_my_posts() {
        $posts = get_all_my_post($_SESSION["user_id"]);
        
        if ($posts) {
            foreach ($posts as $post) {
                $accountname = get_account_name($post["USERID"]);
                $status = $post["POST_STATUS"];
                $stat = ($status > 0) ? "Approved" : "Pending";
                $color = ($status > 0) ? "bg-primary" : "bg-warning";
                
                echo '
                <div class="card mb-4 p-4">
                    <p style="font-size:11px;">Posted by: <strong style="text-transform: uppercase;">'.$accountname.'</strong></p>
                    <p style="font-size:9px; margin-top: -1rem;">'.$post['post_date'].'</p>
                    <p class="'.$color.'" style="padding:3px; font-size:9px;color: #fff; margin-top: -1rem; width:fit-content;">'.$stat.'</p>
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
