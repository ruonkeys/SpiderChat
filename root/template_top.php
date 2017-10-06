<?php
//file including this page must include check_login_status.php at its top
$envelope = "<span><i class=\"fa fa-envelope\" title=\"This envelope is for logged in users\" style=\"color:#808080\"></i></span>";
$chatList = "";
$allFriends = "";
$loginLink = "<a href=\"login_test.php\">Log In</a>&nbsp;|&nbsp;<a href=\"signUp.php\">Sign Up</a>";
if($user_ok == true)
{
  $sql = "select notescheck from users where username='$login_username' limit 1";
  $query = mysqli_query($conn, $sql);
  $notes_date = mysqli_fetch_row($query);

  $sql = "select COUNT(id) from notifications where username='$login_username' and date_time > '$notes_date[0]'";
  $query1 = mysqli_query($conn, $sql);
  $notes_num = mysqli_fetch_row($query1);
  if($notes_num[0]==0)
  {
    $envelope = "<span><a href=\"notifications.php\"><i class=\"fa fa-envelope\" title=\"Your Notifications and Friend requests\" style=\"color:#ccc\"></i></a></span>";
  }
  else
  {
    $envelope = "<span><a href=\"notifications.php\"><i class=\"fa fa-envelope\" title=\"Your have new Notifications\" style=\"color:#ccc\"></i></a><span class=\"notes_badge\">$notes_num[0]</span></span>";
  }
  $loginLink = "<a href=\"user.php?u=".$login_username."\">$login_username</a>&nbsp;|&nbsp;<a href=\"logout.php\">Log Out</a>";

  $chatList = "ChatList";
  $allFriends = "Friends";
}
?>

<div class="top">
  <div class="top_wrap">
    <div class="top_0">
     <a href="index.php"><img src="images/spiderChatLogo.PNG" alt="logo" title="SpiderChat"/></a>
    </div>
    <div class="top_1">
      <div class="top_1_0">
        <span class="top_1_0_0">
         <?php echo $envelope; ?>
         <?php echo $loginLink; ?>
        </span>
      </div>
      <div class="top_1_1">
       <div class="top_1_1_0">
           <ul>
            <li><a href="index.php" title="SpiderChat-HOME"><i class="fa fa-home"></i></a></li>
            <li><a href="chat_list.php" class="menu_item"><?php echo $chatList ?></a></li>
            <li><a href="friend_list.php" class="menu_item"><?php echo $allFriends ?></a></li>
           </ul> 
       </div>
       <div class="top_1_1_1">
         <div class="search_wrap">
          <input type="text" class="search_box" name="search"/>
          <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
         </div>
       </div>
       <div class="clear_fix"></div>
      </div>
    </div>
    <div class="clear_fix"></div>
  </div>  
</div>
