<?php

require_once __DIR__ . '/vendor/autoload.php';

//$_ENV["DOCKER_HOST"]="127.0.0.1:2375";
//$_ENV["DOCKER_HOST"]="unix:///var/run/docker.sock";
//$_ENV["DOCKER_TLS_VERIFY"]="flase";
//$_ENV["DOCKER_CERT_PATH"]="";
//$_ENV["DOCKER_PEER_NAME"]="";

//use Amp\Loop;
use Docker\API\Model\ContainersCreatePostBody;
use Docker\Docker;

$docker = Docker::create();

//$containerConfig = new ContainersCreatePostBody();
//$containerConfig->setImage('nginx:latest');
//$containerConfig->setCmd(['echo', 'I am running a command']);

//$containerCreateResult = $docker->containerCreate($containerConfig);

$containers = $docker->containerList();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    print('id: '.$id."\n");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Connection: Keep-Alive'));
    curl_setopt($ch, CURLOPT_URL, "http:/v1.37/containers/$id/logs?stdout=1");
    curl_setopt($ch, CURLOPT_UNIX_SOCKET_PATH, '/var/run/docker.sock');
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $output = curl_exec($ch);
    curl_close($ch);
    print('Logs: '."\n".$output."\n");

//    $stream = $docker->containerLogs($id, array(
//		'follow' => false,
//		'stdout' => true,
//		'stderr' => true,
//		'tail' => $n
//        )
//    );
//    var_dump($stream);
//    $stdoutFull = "";
//    $stream->onStdout(function ($stdout) use (&$stdoutFull) {
//            $stdoutFull .= $stdout;
//        });
//        $stream->onStderr(function ($stderr) use (&$stderrFull) {
//            $stdoutFull .= $stderr;
//        });

//        $stream->wait();
//        return $stdoutFull;


//    $ContainerLogResult = $docker->getContainerManager()->logs($id, ['stdout' => true, 'stderr' => true ]);
//    var_dump($ContainerLogResult);
//    $output = $containerLogsResult->getBody()->getContents();
//    var_dump($output);
//    $hex = bin2hex($output[0]);
//    $streamId = hexdec($hex);
//    $content = substr($content, 8, $length);
//    echo 'standard output: ' . $containerLogsResult->getStdOut() . "\n";
//    echo 'standard error: ' . $containerLogsResult->getStdErr() . "\n";
//    print_r('<pre>'.$log.'</pre>');
//    var_dump($hex);
//    var_dump($streamId);
//    var_dump($content);
//    print('Logs: '.$log."\n");
//    $attachStream = $docker->containerAttach($id, [
//	'stream' => true,
//	'stdin' => true,
//	'stderr' => true,
//	'stdout' => true
//    ]);
//    $attachStream->onStdout(function ($stdout) {
//	echo $stdout;
//    });
//    $attachStream->onStdout(function ($stderr) {
//	echo $stderr;
//    });
//    var_dump($attachStream);
//    $attachStream->wait(5);
    exit();
}

?>

<html>
<body>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
 function showLog(container_id) {
    var html = $.ajax({
    type: "POST",
    url: "/index.php",
    async: true,
    data: {
	log_start: 1,
	id: container_id
	},
    success: function (result) {
        output = result;
    },
    error: function failCallBk(XMLHttpRequest, textStatus, errorThrown) {
        alert("An error occurred while processing your request. Please try again.");
    }
    }).responseText;
    document.getElementById('log').innerHTML = output;
 }
</script>
<script>
 function stopLog(container_id) {
    var html = $.ajax({
    type: "POST",
    url: "/index.php",
    async: true,
    data: {
	    logStop: 1,
	    id: container_id
	}
    }).responseText;
    document.getElementById('log').innerHTML = 'stopped';
 }
</script>
</head>
<h2>Docker containers info</h2>
<div style="display: block; border: 1px solid; padding: 10px 10px 0 10px;">

<?php
foreach ($containers as $container) {
    $container_id = $container->getID();
    print('<div style="border: 1px solid red; padding: 10px; margin: 0 0 10px 0;">'."\n");
    print('ID: '.$container_id.'<br>'."\n");
    print('Image: '.$container->getImage().'<br>'."\n");
    print('Name: '.implode($container->getNames()).'<br>'."\n");
//    var_dump($container);
    print('<input type="submit" value="Show log" onClick="showLog(\''.$container_id.'\')">'."\n");
    print('</div>'."\n");
}

?>

</div>
<h5>Log:</h5>
<input id="stopBtn" type="submit" value="ClearLog" onClick="stopLog(id)"><br><br>
<div style="display:block; padding: 10px; height: 500px;" id="log">
</div>
<br>
</body>
</html>