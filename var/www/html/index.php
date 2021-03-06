<?php
include('../common.php');
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html><head>';
echo '<title>TorHost\'s Hosting</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<meta name=viewport content="width=device-width, initial-scale=1">';
echo '</head><body>';
echo '<p>Info | <a href="register.php">Register</a> | <a href="login.php">Login</a> | <a href="list.php">List of hosted sites</a></p>';
echo '<p>Here you can get yourself a hosting account on my server.</p>';
echo '<p>What you will get:</p>';
echo '<ul>';
echo '<li>Chose between PHP 7.0 or 7.1</li>';
echo '<li>Nginx Webserver</li>';
echo '<li>SQLite support</li>';
echo '<li>1 MariaDB (MySQL) database</li>';
echo '<li><a href="/phpmyadmin/" target="_blank">PHPMyAdmin</a> and <a href="/adminer/" target="_blank">Adminer</a> for web based database administration</li>';
echo '<li><b>No Web-based file management yet, you\'ll need to use an FTP client like <a href="https://filezilla-project.org/">FileZilla</a> (<a href="http://torhostxjah7oso6.onion/tutorials/torify-ftp/" target="_blank">Torify FileZilla</a>) for now, to manage files. A web based file manager is planned.</b></li>';
echo '<li>FTP access</li>';
echo '<li>SFTP access</li>';
echo '<li>No disk quota</li>';
echo '<li>mail() can send e-mails from your.onion@' . ADDRESS . ' (your.onion@hosting.hosting2271.ddns.net for clearnet)</li>';
echo '<li>Webmail and IMAP, POP3 and SMTP access to your mail account</li>';
echo '<li>Mail sent to anything@your.onion gets automatically redirected to your inbox</li>';
echo '<li>Your own .onion address</li>';
echo '<li>There is a missing feature or you need a special configuration? Just <a href="http://torhostxjah7oso6.onion/contact.php">contact me</a> and I\'ll see what I can do.</li>';
echo '<li>Empty accounts will be deleted after a month</li>';
echo '<li>More to come…</li>';
echo '</ul>';
echo '<h2>Rules</h2>';
echo '<ul>';
echo '<li>No child pornography!</li>';
echo '<li>No terroristic propaganda!</li>';
echo '<li>No illegal content according to German law!</li>';
echo '<li>No malware! (e.g. botnets)</li>';
echo '<li>No phishing!</li>';
echo '<li>No scams!</li>';
echo '<li>No spam!</li>';
echo '<li>No shops! (mostly scams anyway)</li>';
echo '<li>No proxy scripts!</li>';
echo '<li>No IP logger or similar de-anonymizer sites!</li>';
echo '<li>I preserve the right to delete any site for violating these rules and adding new rules at any time.</li>';
echo '</ul>';
echo '</body></html>';
?>
