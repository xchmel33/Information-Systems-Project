<div id="user_list">
    <?php
    $i=0;
    foreach ($data['user_array'] as $user){
        echo '<div id="user'.$i.'" style="border: 1px black solid; padding: 5px 0;" >';
        echo '<form id="form'.$user["user_id"].'" method="post" action="admin">
                <input name="user_id" hidden value="'.$user['user_id'].'">
                <input name="user_i" hidden value="'.$i.'">
                <label>Username:</label>
                <input name="username" value="'.$user["username"].'">
                <label>Email:</label>
                <input name="email" value="'.$user["email"].'">
                <label>Password:</label>
                <input name="password" value="'.$user["password"].'">
                <label>User role:</label>
                <input name="user_role" value="'.$user["user_role"].'">
                <label>City:</label>
                <input name="city" value="'.$user["city"].'">
                <label>Country:</label>
                <input name="country" value="'.$user["country"].'">
                <input type="submit" value="Save">
                <button id="delete_user" onclick="conf_delete(\''.$user["username"].'\',\''.$user["user_id"].'\')">Delete user</button>
                <input id="delete_switch'.$user['user_id'].'" name="delete" hidden>
              </form>';
        echo '</div>'; // "user'.$i.'"
        $i++;
    }
    ?>
</div>
<script type="text/javascript">
    function conf_delete(username,id){
        if (confirm("Delete user "+username+" ?")){
            console.log(username);
            document.getElementById('delete_switch'+id).value = id;
            // document.getElementById('form'+id).submit();
        }
    }
    <?php
        if (!$data['edit_result']){
            echo 'alert("Editing user attributes failed!")';
        }
    ?>
</script>


