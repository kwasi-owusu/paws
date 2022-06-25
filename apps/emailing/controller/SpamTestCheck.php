<?php
session_start();
class SpamTestCheck
{
    public static function testSpam()
    {
        $tkn = trim($_POST['tkn']);
        $error = false;

        if (isset($_SESSION['spamTestTkn']) && $_SESSION['spamTestTkn'] == $tkn) {

            $email = strip_tags(trim($_POST['email']));

            $getEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

            if (empty($getEmail)) {
                $error = true;
                echo "Email address cannot be empty";
            } elseif (!$error) {

                //check if domain is blacklisted

                $email_parts = explode("@", $getEmail);
                $parsed_email = $email_parts[1];


                $parsed = parse_url($parsed_email);

                if (!isset($parsed['host']))
                    return 'malformed';

                // Remove www. from domain (but not from www.com)
                $parsed['host'] = preg_replace('/^www\.(.+\.)/i', '$1', $parsed['host']);

                // The 3 major blacklists
                $blacklists = array(
                    "blocklist.de/lists/ssh.txt",
                    "blocklist.de/lists/apache.txt",
                    "blocklist.de/lists/asterisk.txt",
                    "blocklist.de/lists/bots.txt",
                    "blocklist.de/lists/courierimap.txt",
                    "blocklist.de/lists/courierpop3.txt",
                    "blocklist.de/lists/email.txt",
                    "blocklist.de/lmostists/ftp.txt",
                    "blocklist.de/lists/imap.txt",
                    "blocklist.de/lists/pop3.txt",
                    "blocklist.de/lists/postfix.txt",
                    "blocklist.de/lists/proftpd.txt",
                    "blocklist.de/lists/sip.txt",
                    "ciarmy.com/list/ci-badguys.txt",
                    "sbl.spamhaus.org",
                    "xbl.spamhaus.org",
                    "zen.spamhaus.org"
                );

                // Check against each black list, exit if blacklisted
                // foreach ($blacklists as $blacklist) {
                //     $domain = $parsed['host'] . '.' . $blacklist . '.';
                //     $record = dns_get_record($domain);

                //     echo $record;

                //     // if (count($record) > 0) {
                //     //     echo "Email is blacklisted";
                //     // }
                // }

                $dmarc = dns_get_record($parsed, DNS_TXT);
                echo "DMARC is ". $dmarc;

                echo " \n Domain is ". $parsed['host'];

                // All clear, probably not spam
                echo "Email is not blacklisted";
            }
        } else {
            echo "Action is not allowed";
        }
    }
}

SpamTestCheck::testSpam();
