<html>

<head>
    <title>Aliens Abducted Me - Report an Abduction</title>
</head>

<body>
    <h2>Aliens Abducted Me - Report an Abduction</h2>
    <?php
    $when_it_happened = $_POST['whenithappened'];
    $how_long = $_POST['howlong'];
    $alien_description = $_POST['aliendescription'];
    $fang_spotted = $_POST['fangspotted'];
    $email = $_POST['email'];
    $how_many = $_POST['howmany'];
    $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
    $what_they_did = $_POST['whattheydid'];
    $other = $_POST['other'];

    echo 'thanks for submitting the form <br/>';
    echo 'you wre abducted ' . $when_it_happened;
    echo ' and were gone for ' . $how_long . '<br/>';
    echo 'Describe them:' . $alien_description . '<br/>';
    echo 'Was fang there?' . $fang_spotted . '<br/>';
    echo 'Your email is:' . $email;

    // $msg = $name . ' was abducted ' . $when_it_happened . ' and were gone for ' . $how_long . '.\n' .
    //     'Number of Aliens: ' . $how_many . '\n' .
    //     'Alien description' . $alien_description . '\n' .
    //     'What they did: ' . $what_they_did . '\n' .
    //     'Fang spotted: ' . $fang_spotted . '\n' .
    //     'Other comments: ' . $other;
    // echo '<br/>' . $msg;

    // 简化
    $msg = "$name was abducted $when_it_happened and was gone for $how_long. \n" .
        "Number of Aliens: $how_many \n" .
        "Alien description: . $alien_description \n" .
        "What they did: $what_they_did \n" .
        "Fang spotted: $fang_spotted \n" .
        "Other comments: $other";
    echo $msg;

    $subject = 'Aliens Abducted Me - Abduction Report';
    $to = '1792568382@qq.com';
    mail($to, $subject, $msg, 'From:'.$email);
    ?>
</body>

</html>