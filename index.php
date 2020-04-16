<?php
$title					= 'Kanekes Project Lists';
$directory				= __DIR__;
$domain 				= '.local';
$show_project           = 'both'; // directory, domain, both
$scanned_directories	= array_diff(scandir($directory), array('..', '.'));
$skip_start_with		= array('.');
$skip_file_name		    = array('index.php', 'composer.phar');

if (!empty($_GET['q'])) {
	switch ($_GET['q']) {
		case 'info':
			phpinfo();

			exit;
		break;
	}
}

function startsWith($strings, $start_string) {
	foreach ($strings as $string) {
        $len_string = strlen($string);

        $hasString = substr($string, 0, $len_string) == substr($start_string, 0, $len_string);

		if ($hasString) {
			break;
		}
	}

    return $hasString;
}

function skipFile($strings, $filename) {
	foreach ($strings as $string) {
        $skip = $string == $filename;

		if ($skip) {
			break;
		}
	}

    return $skip;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>

        <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Karla';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .opt {
                margin-top: 30px;
				font-size: 150%;
				margin-bottom: 5px;
            }

            a:hover {
              color: red;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
					<?=$title?>
				</div>

                <div class="info"><br />
                      <?php print($_SERVER['SERVER_SOFTWARE']) ?><br />
                      PHP version: <?php print phpversion() ?>   <span><a title="phpinfo()" href="/?q=info">info</a></span><br />
                      Document Root: <?php print ($_SERVER['DOCUMENT_ROOT']); ?><br />
                      Laragon Docs: <a title="Getting Started" href="https://laragon.org/docs" target="_blank">Getting Started</a><br />
                      Database: <a title="phpMyAdmin" href="/phpmyadmin" target="_blank">phpMyAdmin</a><br />
                      App:
							<a title="Laragon Upload" href="/laragon" target="_blank">Upload</a> |
							<a title="phpSysInfo" href="/phpsysinfo" target="_blank">phpSysInfo</a> |
							<a title="Memcached" href="/memcached" target="_blank">Memcached</a> |
							<a title="phpRedisAdmin" href="/phpredisadmin" target="_blank">phpRedisAdmin</a> |
							<a title="adminer" href="/adminer" target="_blank">adminer</a> <br />
                      Website: <a title="Kanekes.com" href="https://kanekes.com" target="_blank">Kanekes.com</a><br />
                      Owner: <a title="Achmad Hadi Kurnia" href="https://achmadhadikurnia.com" target="_blank">Achmad Hadi Kurnia</a><br />
                </div>

                <div class="opt">
                  Project Lists
                </div>

				<?php foreach ($scanned_directories as $scanned_directory): ?>
					<?php if (startsWith($skip_start_with, $scanned_directory) || skipFile($skip_file_name, $scanned_directory)): ?>
						<?php continue ?>
					<?php endif; ?>

                    <?php if (is_dir($scanned_directory)): ?>
                        <?php if (in_array($show_project, array('directory', 'both'))): ?>
                            <a href="<?=strtolower($scanned_directory)?>" target="_blank"><?=$scanned_directory?></a>
                        <?php endif; ?>

                        <?php if (in_array($show_project, array('both'))): ?>
                            |
                        <?php endif; ?>

                        <?php if (in_array($show_project, array('domain', 'both'))): ?>
                            <a href="http://<?=strtolower($scanned_directory.$domain)?>" target="_blank"><?=$scanned_directory.$domain?></a>
                        <?php endif; ?>
					<?php else: ?>
						<a href="<?=strtolower($scanned_directory)?>" target="_blank"><?=$scanned_directory?></a>
					<?php endif; ?>
					<br>
				<?php endforeach; ?>
            </div>
        </div>
    </body>
</html>