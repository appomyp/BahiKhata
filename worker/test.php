 <?php 

   $app_id = "";
   $app_secret = "";
   $my_url = "http://172.27.22.192/hacku/worker/test.php";

   session_start();
   $code = $_REQUEST["code"];
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $var = $_SESSION['state'];
        $val = $_SESSION['state']; 
     $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
  //   echo("Hello " . $user->name."<br/>");
     $graph_url = "https://graph.facebook.com/me/friends?access_token="
       . $params['access_token'];
     $user_friends = json_decode(file_get_contents($graph_url));
     $html = "<div id = '".($user -> id)."'>".($user->name)."</div><div id='myfriends'>";
     //echo("Your friendlist<br/>");
     //echo $html;
     //ksort($user_friends->data);
    $userFile = fopen("uFile.txt", "w");
    fwrite($userFile, $user -> id);
    fclose($userFile);
    
     foreach($user_friends->data as $user)
     {
          $name = $user->name;
          $id =  $user->id;
          $html = $html. "<div id = '".$id."' class='fList'>".$name."</div>";
          //nameArray['$user->id'] = $user->name; 
     }
     $html = $html . "</div>";
     //echo $html;
     $fp = fopen("friendList.html", "w");
     fwrite($fp, $html);
     fclose($fp);
     
     echo '<a href="../index.html">goto index</a>';
  ?>
