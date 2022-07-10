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

            if (empty($email)) {
                $error = true;
                echo "Email address cannot be empty";
            } elseif (!$error) {

                //check if domain is blacklisted

                $email_parts = explode("@", $getEmail);
                $parsed_domain = $email_parts[1];

                $parsed = parse_url($parsed_domain);

                $full_url = "www." . $parsed_domain;

                $get_domain_ip =  gethostbyname($full_url);

                //databases to check
                $dns_db_lookup = array(
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
                    "zen.spamhaus.org",
                    "dnsbl-1.uceprotect.net",
                    "all.s5h.net",
                    "wormrbl.imp.ch",
                    "dnsbl-2.uceprotect.net",
                    "blacklist.woody.ch",
                    "dnsbl-3.uceprotect.net",
                    "combined.abuse.ch",
                    "dnsbl.spfbl.net",
                    "dnsbl.dronebl.org",
                    "http.dnsbl.sorbs.net",
                    "spam.dnsbl.sorbs.net",
                    "dyna.spamrats.com"

                );


                if ($get_domain_ip) {
                    $reverse_ip = implode(".", array_reverse(explode(".", $get_domain_ip)));

                    foreach ($dns_db_lookup as $host)
                        if (checkdnsrr("$reverse_ip.$host.", "A")) {
                            echo "$get_domain_ip ($parsed_domain) <font color='red'><strong>is blacklisted in </strong></font> $host<br />\n";
                        } else {
                            echo "$get_domain_ip ($parsed_domain) <font color='green'><strong>passed in </strong></font> $host<br />\n";
                        }
                }

                //demarc check 
                // $dmk = dns_get_record("_dmarc".$parsed_email, DNS_TXT);
                // print_r($dmk);

                // Check against each black list, exit if blacklisted
                // foreach ($blacklists as $blacklist) {
                //     $domain = $get_domain_ip . '.' . $blacklist . '.';



                //     // if (count($record) > 0) {
                //     //     echo "Email is blacklisted";
                //     // }
                // }

                $DNS_MX_record = dns_get_record("_dmarc." . $parsed_domain, DNS_TXT);

                $SPF_record = dns_get_record($parsed_domain, DNS_TXT);

                echo "<hr />";
                if (isset($SPF_record[0]["txt"])) {
                    echo "<p>SPF Record " . $SPF_record[0]["txt"] . "</p>";
                }
                else{
                    echo "<p>SPF Record returned empty</p>";
                }

                if (isset($DNS_MX_record[0]["txt"])) {
                    echo "<p>DMARC Record " . $DNS_MX_record[0]["txt"] . "</p>";
                }

                else{
                    echo "<p>DMARC Record returned empty</p>";
                }

                // foreach ($DNS_MX_record as $ar) {

                //     foreach ($ar as $key => $val) {
                //         echo "DMARC Record" .$key . ":" . $val . "</br>";
                //     }
                //     echo "</br>";
                // }
            }
        } else {
            echo "Action is not allowed";
        }
    }
}

SpamTestCheck::testSpam();
