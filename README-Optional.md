Optional - Section Removed from main to streamline

Backup files in case overwritten
--------------------------------
cp /etc/ssh/sshd_config /root
cp /etc/rc.local /root
cp /etc/vsftpd.conf /root
cp /etc/apt/sources.list /root


usermod -aG sasl postfix

postmulti -e init
postmulti -I postfix-clearnet -e create
postmulti -i clearnet -e enable
postmulti -i clearnet -p start

postmap /etc/postfix/canonical /etc/postfix/sender_login_maps /etc/postfix/transport
postmap /etc/postfix-clearnet/canonical /etc/postfix-clearnet/sasl_password /etc/postfix-clearnet/transport # only if you have a second instance

Only if you overwrote it if not skip
------------------------------------
cp /etc/rc.local /root

Restore to default if this file overwrote if not skip!
------------------------------------------------------
nano /etc/rc.local   

overwrite the sshd_config back to defualt otherwise you
will not be able to connect using the one in this archive.
----------------------------------------------
cp /root/sshd_config /etc/ssh/

replace sources.list # if you overwrote if not skip
----------------------------------------------------
cp /root/sources.list /etc/apt/  


Install squirrelmail for web based mail management grab the latest squirrelmail and install it in /var/www/html/squirrelmail:
---------------------------------------------------------------------------------------------------------
cd /var/www/html/ && svn checkout https://svn.code.sf.net/p/squirrelmail/code/trunk/squirrelmail && cd squirrelmail && ./configure
