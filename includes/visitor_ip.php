<?PHP
$conn = mysqli_connect('localhost','root','','tourism_point'); 
if(!$conn){
    die ("Not Connected.");
}

function getIP() {
    $ip = $_SERVER['SERVER_ADDR'];

    if (PHP_OS == 'WINNT'){
        $ip = getHostByName(getHostName());
    }

    if (PHP_OS == 'Linux'){
        $command="/sbin/ifconfig";
        exec($command, $output);
        $pattern = '/inet addr:?([^ ]+)/';

        $ip = array();
        foreach ($output as $key => $subject) {
            $result = preg_match_all($pattern, $subject, $subpattern);
            if ($result == 1) {
                if ($subpattern[1][0] != "127.0.0.1")
                $ip = $subpattern[1][0];
            }
        }
    }
    return $ip;
}

$user_ip = getIP();
$q="select * from visitors where user_IP='$user_ip'";
$r=mysqli_query($conn,$q);
if(!mysqli_num_rows($r)){
    $query = "insert into visitors(user_IP) values('$user_ip')";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Not Inserted".mysqli_error($conn));
    }
}
    
?>