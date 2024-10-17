<?php 
        function getFollowersQuery($userId) {
            return "
                SELECT users.*
                FROM followers
                LEFT JOIN users ON users.id=followers.following_user_id
                WHERE followers.followed_user_id='$userId'
                GROUP BY users.id";
        }

?>